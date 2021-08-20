<?php

namespace backend\actions;

use Yii;
use yii\base\Action;

/**
 * Class ViewAction
 * @package backend\actions
 */
final class ViewAction extends Action
{
    /**
     * Displays a single Category model.
     * @return mixed
     */
    public function run()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->controller->findModel($id);

        return $this->controller->render(
            'view',
            [
                'model' => $model,
            ]
        );
    }
}
