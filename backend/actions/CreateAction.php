<?php

namespace backend\actions;

use yii\base\Action;
use Yii;

/**
 * Class CreateAction
 * @package backend\actions
 */
final class CreateAction extends Action
{
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function run()
    {
        $modelClass = $this->controller->getModelClass();
        $model = new $modelClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->controller->render('create', [
                'model' => $model,
            ]);
        }
    }
}