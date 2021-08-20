<?php

use yii\helpers\Html;

/** @var string $nowLanguage */
/** @var string $nowUrl */

if ($nowLanguage == 'ru' || $nowLanguage == 'ru-RU') {
    echo Html::a('Go to English', [$nowUrl, 'language' => 'en']);
} elseif ($nowLanguage == 'en' || $nowLanguage == 'en-US') {
    echo Html::a('Перейти на русский', [$nowUrl, 'language' => 'ru']);
}
