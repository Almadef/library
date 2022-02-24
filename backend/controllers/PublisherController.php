<?php

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\UpdateAction;
use backend\actions\ViewAction;
use backend\controllers\interfaces\MergeBaseActionInterface;
use backend\controllers\traits\CacheManagementTraits;
use common\models\Publisher;
use common\models\publisher\Search;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PublisherController implements the CRUD actions for Publisher model.
 */
final class PublisherController extends Controller implements MergeBaseActionInterface
{
    use CacheManagementTraits;

    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'index' => IndexAction::class,
                'view' => ViewAction::class,
                'create' => CreateAction::class,
                'update' => UpdateAction::class,
                'delete' => DeleteAction::class,
            ]
        );
    }

    /**
     * @return Search
     */
    public function getSearchModel()
    {
        return new Search();
    }

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Publisher::class;
    }

    /**
     * @param $id
     * @return Publisher|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Publisher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('error', 'The requested page does not exist.'));
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['viewPublisher'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewPublisher'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createPublisher'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updatePublisher'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deletePublisher'],
                    ],
                ],
            ],
        ];
    }
}
