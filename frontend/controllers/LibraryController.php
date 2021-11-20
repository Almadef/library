<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\IdxLibrary;
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
    private const LIST_PAGE_SIZE = 8;

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $queryBook = Book::find()
            ->isNoDeleted();

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
            ]
        );
    }

    /**
     * @param int $category_id
     * @return mixed
     */
    public function actionCategory(
        int $category_id
    ) {
        $queryBook = Book::find()
            ->isNoDeleted()
            ->joinWith('categories')
            ->andWhere(['{{%category}}.id' => $category_id]);

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
            ]
        );
    }

    /**
     * @param int $author_id
     * @return mixed
     */
    public function actionAuthor(
        int $author_id
    ) {
        $queryBook = Book::find()
            ->isNoDeleted()
            ->joinWith('authors')
            ->andWhere(['{{%author}}.id' => $author_id]);

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
            ]
        );
    }

    /**
     * @param int $publisher_id
     * @return mixed
     */
    public function actionPublisher(
        int $publisher_id
    ) {
        $queryBook = Book::find()
            ->isNoDeleted()
            ->joinWith('publisher')
            ->andWhere(['{{%publisher}}.id' => $publisher_id]);

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
            ]
        );
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function actionSearch(
        string $search
    ) {
        $idsBook = IdxLibrary::search($search);

        $queryBook = Book::find()
            ->isNoDeleted()
            ->byId($idsBook);

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
            ]
        );
    }

    /**
     * @return mixed
     */
    public function actionFavourites()
    {
        $queryBook = Book::find()
            ->joinWith('currentUser')
            ->isNoDeleted();

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => self::LIST_PAGE_SIZE]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'list',
            [
                'pages' => $pages,
                'books' => $books,
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

        return $this->render(
            'book',
            [
                'book' => $book,
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
                'only' => ['index', 'category', 'author', 'publisher', 'search'],
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
