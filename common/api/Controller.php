<?php

namespace common\api;

use stdClass;
use Yii;
use yii\web\Controller as BaseController;
use yii\web\HttpException;
use yii\web\Response;

abstract class Controller extends BaseController
{
    protected $response;
    protected $data;

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->on(
            'beforeSend',
            function ($event) {
                $exception = Yii::$app->errorHandler->exception;
                if ($exception !== null) {
                    $errorResponse = $this->getErrorResponse($exception->getMessage());
                    if (!$exception instanceof HttpException && YII_DEBUG && YII_ENV_DEV) {
                        $errorResponse->exception = $exception;
                    }
                    $event->sender->data = $errorResponse;
                }
            }
        );

        $this->initResponse();
        return parent::beforeAction($action);
    }

    protected function getErrorResponse($message)
    {
        foreach ($this->response as $key => $value) {
            unset($this->$key);
        }

        Yii::$app->response->statusCode = 400;
        $this->response->result = 'fail';
        $this->response->error_message = $message;
        return $this->response;
    }

    protected function initResponse()
    {
        $this->response = new stdClass();
    }

    protected function addToResponseData($value, $key)
    {
        $this->response->$key = $value;
    }

    protected function getSuccessResponse()
    {
        $this->response->result = 'success';
        return $this->response;
    }
}
