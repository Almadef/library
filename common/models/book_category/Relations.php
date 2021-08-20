<?php

namespace common\models\book_category;

use common\models\Book;
use common\models\Category;
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
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
