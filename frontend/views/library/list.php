<?php

use common\models\Category;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $pages Pagination */
/* @var $books \common\models\Book[] */
/* @var $categories Category[] */

$this->title = Yii::t('app', 'Home');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-10 col-md-10">
                <?php
                if (empty($books)) :
                    ?>
                    <h2 class="text-center"><?= Yii::t('app', 'Books not find') ?></h2>
                    <?php
                else :
                    foreach ($books as $book) :
                        ?>
                        <div class="col-3 col-sm-3">
                            <div>
                                <a href="<?= Url::to(['library/book', 'book_id' => $book->id]) ?>"
                                   class="a-no-decoration"
                                   style="text-decoration: none;">
                                    <div class="panel panel-primary panel-main">
                                        <div class="panel-body">
                                            <?= Html::img(
                                                Yii::$app->storage->getUrl(
                                                    $book->fileCover->description,
                                                    $book->fileCover->file_path
                                                ),
                                                ['alt' => $book->title, 'height' => 250]
                                            ) ?>
                                            <?= mb_strimwidth(
                                                Yii::t(
                                                    'app',
                                                    'Name: {name}',
                                                    [
                                                        'name' => $book->title
                                                    ]
                                                ) . '<br>' . Yii::t(
                                                    'app',
                                                    'Author(s): {author}',
                                                    [
                                                        'author' => $book->getAuthorsString(),
                                                    ]
                                                ),
                                                0,
                                                70,
                                                "..."
                                            ) ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
                <div class="col-12 col-sm-12 text-center">
                    <?= LinkPager::widget(
                        [
                            'pagination' => $pages,
                        ]
                    ); ?>
                </div>
            </div>
            <div class="col-2 col-md-2">
                <?= $this->render('_categories', ['categories' => $categories]) ?>
            </div>
        </div>
    </div>
</div>
