<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\Category;
use common\models\IdxLibrary;
use common\models\UserBook;
use Yii;
use yii\caching\TagDependency;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * LibraryController controller
 */
final class LibraryController extends Controller
{
    /**
     * Displays homepage.
     *
     * @param string|null $search
     * @param int|null $category_id
     * @param int|null $author_id
     * @param int|null $publisher_id
     * @return mixed
     */
    public function actionIndex(
        string $search = null,
        int $category_id = null,
        int $author_id = null,
        int $publisher_id = null
    ) {
        $queryBook = Book::find()
            ->isNoDeleted();

        if (isset($search)) {
            $idsBook = IdxLibrary::search($search);
            $queryBook->byId($idsBook);
        }
        if (isset($category_id)) {
            $queryBook->joinWith('categories');
            $queryBook->andWhere(['{{%category}}.id' => $category_id]);
        }
        if (isset($author_id)) {
            $queryBook->joinWith('authors');
            $queryBook->andWhere(['{{%author}}.id' => $author_id]);
        }
        if (isset($publisher_id)) {
            $queryBook->joinWith('publisher');
            $queryBook->andWhere(['{{%publisher}}.id' => $publisher_id]);
        }

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => 8]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $categories = Category::find()
            ->isNoDeleted()
            ->all();

        return $this->render(
            'index',
            [
                'pages' => $pages,
                'books' => $books,
                'categories' => $categories,
            ]
        );
    }

    /**
     * @return mixed
     */
    public function actionFavourites()
    {
        $userId = Yii::$app->user->id;
        $queryBook = Book::find()
            ->joinWith('currentUser')
            ->isNoDeleted();

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => 8]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $categories = Category::find()
            ->isNoDeleted()
            ->all();

        return $this->render(
            'index',
            [
                'pages' => $pages,
                'books' => $books,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Displays book.
     *
     * @param int $book_id
     * @return mixed
     */
    public function actionBook(int $book_id)
    {
        $book = Book::find()
            ->isNoDeleted()
            ->byId($book_id)
            ->one();

        $categories = Category::find()
            ->isNoDeleted()
            ->all();

        return $this->render(
            'book',
            [
                'book' => $book,
                'categories' => $categories,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'cache_index' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 300,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->request->get('search'),
                    Yii::$app->request->get('category_id'),
                    Yii::$app->request->get('author_id'),
                    Yii::$app->request->get('publisher_id'),
                    Yii::$app->request->get('page'),
                ],
                'dependency' => [
                    'class' => TagDependency::class,
                    'tags' => 'library_index'
                ],
            ],
            'cache_favourites' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['favourites'],
                'duration' => 300,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->request->get('page'),
                    Yii::$app->user->id,
                ],
                'dependency' => [
                    'class' => TagDependency::class,
                    'tags' => ['library_index', 'library_favourites_' . Yii::$app->user->id]
                ],
            ],
            'cache_book' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['book'],
                'duration' => 300,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->request->get('book_id'),
                    Yii::$app->user->id,
                ],
                'dependency' => [
                    'class' => TagDependency::class,
                    'tags' => ['library_index', 'library_favourites_' . Yii::$app->user->id]
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['favourites'],
                'rules' => [
                    [
                        'actions' => ['favourites'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
