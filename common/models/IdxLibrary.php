<?php

namespace common\models;

use common\helpers\LanguagesHelper;
use yii\sphinx\ActiveRecord;
use yii\sphinx\MatchExpression;

/**
 * Class IdxLibrary
 * @package common\models
 *
 * @property int $id
 */
final class IdxLibrary extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function indexName()
    {
        return 'idx_library';
    }

    /**
     * @param string $param
     * @return array
     */
    public static function search(string $param): array
    {
        $idxBooks = self::find()
            ->match(
                (new MatchExpression())
                    ->match([LanguagesHelper::getCurrentAttribute('book_title') => $param])
                    ->orMatch([LanguagesHelper::getCurrentAttribute('cat_title') => $param])
                    ->orMatch([LanguagesHelper::getCurrentAttribute('pub_name') => $param])
                    ->orMatch([LanguagesHelper::getCurrentAttribute('auth_name') => $param])
                    ->orMatch([LanguagesHelper::getCurrentAttribute('auth_surname') => $param])
                    ->orMatch([LanguagesHelper::getCurrentAttribute('auth_patronymic') => $param])
            )
            ->all();
        $ids = [];
        foreach ($idxBooks as $idxBook) {
            $ids[] = $idxBook->book_id;
        }
        return $ids;
    }
}
