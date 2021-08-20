<?php

namespace common\models\publisher;

use common\models\Book;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\publisher
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['publisher_id' => 'id'])->andWhere(['is_deleted' => false]);
    }
}
