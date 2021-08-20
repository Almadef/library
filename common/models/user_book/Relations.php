<?php

namespace common\models\user_book;

use common\models\Book;
use common\models\User;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\user_book
 */
trait Relations
{
    /**
     * Gets query for [[Book]].
     *
     * @return ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
