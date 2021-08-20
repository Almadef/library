<?php

namespace common\models\user;

use common\models\auth\Assignment;
use common\models\Book;
use common\models\user_book\ActiveRecord as UserBook;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\user
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Assignment::class, ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable(UserBook::tableName(), ['user_id' => 'id'])
            ->andWhere(['{{%book}}.is_deleted' => false]);
    }
}
