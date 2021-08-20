<?php

namespace common\models;

use common\models\category\ActiveRecord;
use common\models\category\Multilang;
use Exception;
use yii\helpers\ArrayHelper;

/**
 * Class Category
 * @package common\models
 *
 * @property int $id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 */
final class Category extends ActiveRecord
{
    use Multilang;

    /**
     * @return array
     * @throws Exception
     */
    public static function getForSelector(): array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(),
            'id',
            'title'
        );
    }
}
