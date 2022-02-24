<?php

namespace common\models;

use common\models\book\ActiveRecord;
use common\models\book\Multilang;
use Exception;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class Book
 * @package common\models
 *
 * @property int $id
 * @property int $publisher_id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $release
 * @property string $isbn
 * @property int $pages
 * @property string|null $description
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 *
 * @property Publisher $publisher
 * @property Storage $fileCover
 * @property Storage $fileBook
 * @property Category[] $categories
 * @property Author[] $authors
 * @property Storage[] $files
 * @property User $currentUser
 * @property User[] $users
 */
final class Book extends ActiveRecord
{
    use Multilang;

    /**
     * @return string
     * @throws Exception
     */
    public function getAuthorsString(): string
    {
        $authors = $this->authors;
        $return = '';
        foreach ($authors as $author) {
            $return .= $author->fullName . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getAuthorsStringLink(): string
    {
        $authors = $this->authors;
        $return = '';
        foreach ($authors as $author) {
            $return .= Html::a($author->fullName, Url::to(['library/author', 'author_id' => $author->id])) . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCategoriesStringLink(): string
    {
        $categories = $this->categories;
        $return = '';
        foreach ($categories as $category) {
            $return .= Html::a($category->title, Url::to(['library/category', 'category_id' => $category->id])) . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }
}
