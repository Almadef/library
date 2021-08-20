<?php

namespace backend\actions;

use Yii;
use yii\base\Action;

/**
 * Class IndexAction
 * @package backend\actions
 */
final class IndexAction extends Action
{
    /**
     * Lists all Category models.
     * @return mixed
     */
    public function run()
    {
        $searchModel = $this->controller->getSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }
}
