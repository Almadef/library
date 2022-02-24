<?php

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\UpdateAction;
use backend\actions\ViewAction;
use backend\controllers\interfaces\MergeBaseActionInterface;
use backend\controllers\traits\CacheManagementTraits;
use common\models\Category;
use common\models\category\Search;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
final class CategoryController extends Controller implements MergeBaseActionInterface
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
        return Category::class;
    }

    /**
     * @param $id
     * @return Category|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
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
                        'roles' => ['viewCategory'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewCategory'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createCategory'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateCategory'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteCategory'],
                    ],
                ],
            ],
        ];
    }
}
