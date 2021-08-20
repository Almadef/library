<?php

namespace common\models\author;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%author}}".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_en
 * @property string $surname_ru
 * @property string $surname_en
 * @property string|null $patronymic_ru
 * @property string|null $patronymic_en
 * @property string fullName
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 */
abstract class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * {@inheritdoc}
     * @return Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Query(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'surname_ru', 'name_en', 'surname_en'], 'required'],
            [
                ['name_ru', 'surname_ru', 'patronymic_ru', 'name_en', 'surname_en', 'patronymic_en'],
                'string',
                'max' => 255
            ],
            [['created_at', 'updated_at'], 'integer'],
            [['is_deleted'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => Yii::t('app', 'Name (ru)'),
            'name_en' => Yii::t('app', 'Name (en)'),
            'surname_ru' => Yii::t('app', 'Surname (ru)'),
            'surname_en' => Yii::t('app', 'Surname (en)'),
            'patronymic_ru' => Yii::t('app', 'Patronymic (ru)'),
            'patronymic_en' => Yii::t('app', 'Patronymic (en)'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true
            ],
        ];
    }
}
