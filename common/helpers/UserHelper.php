<?php

namespace common\helpers;

use common\models\User;
use Yii;
use yii\base\Exception;

/**
 * Class UserHelper
 * @package common\helpers
 */
final class UserHelper
{
    /**
     * @param string $password
     * @return string
     * @throws Exception
     */
    public static function generatePasswordHash(string $password): string
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function generateAuthKey(): string
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function generatePasswordResetToken(): string
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function generateEmailVerificationToken(): string
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @param string $status
     * @return string
     */
    public static function getStatusName(string $status): string
    {
        return User::getStatusForSelector()[$status];
    }
}
