<?php

namespace common\behavior;

use common\models\Storage;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

final class StorageBehavior extends Behavior
{
    public $attributes;

    public function init()
    {
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave()
    {
        foreach ($this->attributes as $attribute) {
            $this->upload($attribute);
        }
    }

    public function upload($attribute)
    {
        $file = UploadedFile::getInstance($this->owner, $attribute['name']);
        if (!isset($file)) {
            return true;
        }
        $fileType = pathinfo($file->name, PATHINFO_EXTENSION);
        $binData = file_get_contents($file->tempName);
        $path = Yii::$app->storage->upload($attribute['description'], $binData, $fileType);
        $storage = new Storage();
        $storage->model_id = $this->owner->id;
        $storage->model_name = $this->owner::className();
        $storage->description = $attribute['description'];
        $storage->file_name = $file->name;
        $storage->file_type = $fileType;
        $storage->file_size = $file->size;
        $storage->file_path = $path;
        return $storage->save();
    }
}
