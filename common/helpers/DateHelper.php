<?php

namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Class DateHelper
 * @package common\helpers
 */
final class DateHelper
{
    /**
     * @param int $unixDate
     * @return string
     * @throws InvalidConfigException
     */
    public static function convertUnixToDatetime(int $unixDate): string
    {
        return Yii::$app->formatter->asDate($unixDate, 'php:Y-m-d H:i:s');
    }
}
