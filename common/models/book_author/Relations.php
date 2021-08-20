<?php

namespace common\models\book_author;

use common\models\Author;
use common\models\Book;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\book
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }
}
