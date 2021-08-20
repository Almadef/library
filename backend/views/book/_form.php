<?php

use common\helpers\LanguagesHelper;
use kartik\select2\Select2;
use vova07\imperavi\Widget as ImperaviRedactor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
/* @var $selectCategory array */
/* @var $selectAuthor array */
/* @var $selectPublisher array */
?>

<div class="book-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher_id')->widget(
        Select2::class,
        [
            'data' => $selectPublisher,
            'options' => [
                'placeholder' => Yii::t('app', 'Select...'),
            ],
        ]
    )->label(Yii::t('app', 'Publisher')) ?>

    <?= $form->field($model, 'release')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pages')->textInput() ?>

    <?= $form->field($model, 'description_ru')->widget(
        ImperaviRedactor::class,
        [
            'settings' => [
                'lang' => LanguagesHelper::getCurrentLanguage(),
                'minHeight' => 200,
                'pastePlainText' => true,
                'buttonSource' => true,
                'plugins' => [
                    'fontcolor',
                    'fullscreen',
                ]
            ]
        ]
    ); ?>
    <?= $form->field($model, 'description_en')->widget(
        ImperaviRedactor::class,
        [
            'settings' => [
                'lang' => LanguagesHelper::getCurrentLanguage(),
                'minHeight' => 200,
                'pastePlainText' => true,
                'buttonSource' => true,
                'plugins' => [
                    'fontcolor',
                    'fullscreen',
                ]
            ]
        ]
    ); ?>

    <?= $form->field($model, 'category_ids')->widget(
        Select2::class,
        [
            'data' => $selectCategory,
            'options' => [
                'placeholder' => Yii::t('app', 'Select...'),
                'multiple' => true
            ],
        ]
    )->label(Yii::t('app', 'Categories')) ?>

    <?= $form->field($model, 'author_ids')->widget(
        Select2::class,
        [
            'data' => $selectAuthor,
            'options' => [
                'placeholder' => Yii::t('app', 'Select...'),
                'multiple' => true
            ],
        ]
    )->label(Yii::t('app', 'Authors')) ?>

    <?php
    if (!isset($model->fileCover)) {
        echo $form->field($model, 'coverFile')->fileInput();
    } else {
        $url = Url::toRoute(['update', 'id' => $model->id, 'fileDeleteId' => $model->fileCover->id]);
        echo '<p>' . Html::a(
            Yii::t('app', 'Deleted cover'),
            $url
        ) . ' ' . Html::a(
            Yii::t('app', 'Watch file'),
            Yii::$app->storage->getUrl($model->fileCover->description, $model->fileCover->file_path),
            ['target' => '_blank']
        ) . '</p>';
    }
    ?>

    <?php
    if (!isset($model->fileBook)) {
        echo $form->field($model, 'bookFile')->fileInput();
    } else {
        $url = Url::toRoute(['update', 'id' => $model->id, 'fileDeleteId' => $model->fileBook->id]);
        echo '<p>' . Html::a(
            Yii::t('app', 'Deleted book'),
            $url
        ) . ' ' . Html::a(
            Yii::t('app', 'Watch file'),
            Yii::$app->storage->getUrl($model->fileBook->description, $model->fileBook->file_path),
            ['target' => '_blank']
        ) . '</p>';
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
