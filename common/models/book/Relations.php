<?php

namespace common\models\book;

use common\helpers\StorageHelper;
use common\models\Author;
use common\models\Book;
use common\models\book_author\ActiveRecord as BookAuthor;
use common\models\book_category\ActiveRecord as BookCategory;
use common\models\Category;
use common\models\Publisher;
use common\models\Storage;
use common\models\User;
use common\models\user_book\ActiveRecord as UserBook;
use Yii;
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
    public function getPublisher()
    {
        return $this->hasOne(Publisher::class, ['id' => 'publisher_id'])
            ->andWhere(['{{%publisher}}.is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable(BookCategory::tableName(), ['book_id' => 'id'])
            ->andWhere(['{{%category}}.is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(BookAuthor::tableName(), ['book_id' => 'id'])
            ->andWhere(['{{%author}}.is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getFileCover()
    {
        return $this->hasOne(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['description' => StorageHelper::BOOK_COVER_DESCRIPTION])
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getFileBook()
    {
        return $this->hasOne(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['description' => StorageHelper::BOOK_BOOK_DESCRIPTION])
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getCurrentUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])
            ->viaTable(UserBook::tableName(), ['book_id' => 'id'])
            ->andWhere(['{{%user}}.id' => Yii::$app->user->id])
            ->andWhere(['{{%user}}.is_deleted' => false]);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable(UserBook::tableName(), ['book_id' => 'id'])
            ->andWhere(['{{%user}}.is_deleted' => false]);
    }
}
