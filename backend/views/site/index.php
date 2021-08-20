<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Home');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php
            if (Yii::$app->user->can('viewBook')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-primary panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Books') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-book glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/book']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
            <?php
            if (Yii::$app->user->can('viewAuthor')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-primary panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Authors') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-pencil glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/author']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
            <?php
            if (Yii::$app->user->can('viewCategory')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-primary panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Categories') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-tags glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/category']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
            <?php
            if (Yii::$app->user->can('viewPublisher')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-primary panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Publishers') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-print glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/publisher']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
            <?php
            if (Yii::$app->user->can('viewUser')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-primary panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Users') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-user glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/user']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
            <?php
            if (Yii::$app->user->can('clearCache')) : ?>
                <div class="col-lg-4 link">
                    <?= Html::a(
                        '
                    <div class="panel panel-danger panel-main">
                                <div class="panel-heading panel-heading-main">
                                    ' . Yii::t('app', 'Clear cache') . '
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-trash glyphicon-main" aria-hidden="true"></i>
                                </div>
                            </div>
                    ',
                        Url::to(['/site/clear-cache']),
                        ['class' => 'a-no-decoration', 'style' => 'text-decoration: none;']
                    ) ?>
                </div>
                <?php
            endif; ?>
        </div>
    </div>
</div>
