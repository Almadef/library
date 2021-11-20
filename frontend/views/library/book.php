<?php

use common\helpers\LanguagesHelper;
use common\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $book \common\models\Book */
/* @var $categories Category[] */

$this->title = Yii::t('app', 'Book {name}', ['name' => $book->title]);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-10 col-md-10">
                <div class="col-4 col-sm-4">
                    <div class="book-page-cover">
                        <?= Html::img(
                            Yii::$app->storage->getUrl(
                                $book->fileCover->description,
                                $book->fileCover->file_path
                            ),
                            ['alt' => $book->title, 'height' => 250]
                        ) ?>
                    </div>
                    <div class="text-center">
                        <?=
                        Html::a(
                            Yii::t('app', 'Read book'),
                            Yii::$app->storage->getUrl($book->fileBook->description, $book->fileBook->file_path),
                            [
                                'title' => Yii::t('app', 'Read book'),
                                'target' => '_blank',
                                'class' => 'btn btn-primary'
                            ]
                        );
?>
                    </div>
                    <br>
                    <div class="text-center">
                        <?= (Yii::$app->user->isGuest) ? '' :
                            Html::a(
                                Yii::t('app', ($book->currentUser) ? 'Delete from favorites' : 'Add to favorites'),
                                '#',
                                [
                                    'title' => Yii::t(
                                        'app',
                                        ($book->currentUser) ? 'Delete from favorites' : 'Add to favorites'
                                    ),
                                    'class' => 'btn btn-' . (($book->currentUser) ? 'danger' : 'success'),
                                    'id' => 'favorite-btn',
                                    'data-lng' => LanguagesHelper::getCurrentLanguage(),
                                    'data-book_id' => $book->id,
                                    'data-action' => ($book->currentUser) ? 'del' : 'add',
                                ]
                            );
?>
                    </div>
                </div>
                <div class="col-8 col-sm-8">
                    <div class="book-page-content">
                        <h1><?= $book->title ?></h1>
                        <p><?= Yii::t('app', 'Author(s): {author}', ['author' => $book->getAuthorsStringLink()]) ?></p>
                        <p><?= Yii::t(
                            'app',
                            'Publisher: {name}',
                            [
                                    'name' => Html::a(
                                        $book->publisher->name,
                                        Url::to(['library/publisher', 'publisher_id' => $book->publisher->id])
                                    )
                                ]
                        ) ?></p>
                        <p><?= Yii::t(
                            'app',
                            'Category(ies): {category}',
                            ['category' => $book->getCategoriesStringLink()]
                        ) ?></p>
                        <p><?= Yii::t('app', 'Pages: {pages}', ['pages' => $book->pages]) ?></p>
                        <p><?= Yii::t(
                            'app',
                            'Release date: {release}',
                            ['release' => Yii::$app->formatter->asDate($book->release, 'php:Y m d')]
                        ) ?></p>
                        <p><?= Yii::t('app', 'ISBN: {isbn}', ['isbn' => $book->isbn]) ?></p>
                        <?php
                        if (isset($book->description) && $book->description !== '') : ?>
                            <h3><?= Yii::t('app', 'Description') ?></h3>
                            <p><?= $book->description ?></p>
                            <?php
                        endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-2 col-md-2">
                <?= $this->render('_categories', ['categories' => $categories]) ?>
            </div>
        </div>
    </div>
</div>
