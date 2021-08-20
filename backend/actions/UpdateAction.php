<?php

namespace backend\actions;

use Yii;
use yii\base\Action;

/**
 * Class UpdateAction
 * @package backend\actions
 */
final class UpdateAction extends Action
{
    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function run()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->controller->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->controller->clearCache();
            return $this->controller->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->controller->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }
}
