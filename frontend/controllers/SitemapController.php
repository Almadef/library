<?php

namespace frontend\controllers;

use common\models\Author;
use common\models\Book;
use common\models\Category;
use common\models\Publisher;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;

/**
 * SitemapController controller
 */
final class SitemapController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $ids = [
            'book' => $this->getModelIds(Book::class),
            'author' => $this->getModelIds(Author::class),
            'category' => $this->getModelIds(Category::class),
            'publisher' => $this->getModelIds(Publisher::class),
        ];

        return $this->renderPartial(
            'index',
            [
            'ids' => $ids,
            ]
        );
    }

    /**
     * @param string $class
     * @return array
     */
    private function getModelIds(string $class): array
    {
        return $class::find()->isNoDeleted()->select("id")->asArray()->column();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' =>  ContentNegotiator::class,
                'only' => ['index'],
                'formats' => [
                    'text/xml' => Response::FORMAT_RAW,
                ],
            ],
        ];
    }
}
