<?php

namespace common\models;

use common\models\author\ActiveRecord;
use common\models\author\Multilang;
use Exception;
use yii\helpers\ArrayHelper;

/**
 * Class Author
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property string $name_en
 * @property string $surname
 * @property string $surname_ru
 * @property string $surname_en
 * @property string|null $patronymic
 * @property string|null $patronymic_ru
 * @property string|null $patronymic_en
 * @property string fullName
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 */
final class Author extends ActiveRecord
{
    use Multilang;

    /**
     * @return array
     */
    public static function getForSelector(): array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(),
            'id',
            'fullName'
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getFullName(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }
}
