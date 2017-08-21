<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Galería';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php for ($i = 1; $i < 11; $i++) : ?>
            <div class="col-md-3">
                <div class="view hm-zoom">
                    <?= Html::a(
                        Html::img(Yii::getAlias('@web') . '/images/gallery/events/thumb-' . $i . '.jpg', [
                            'class' => 'img-responsive',
                            'alt'   => Html::encode('Delishots Desserts'),
                        ]),
                        Yii::getAlias('@web') . '/images/gallery/events/full-' . $i . '.jpg',
                        [
                            'data-fancybox' => "gallery",
                            'data-caption'  => "Delishots Desserts",
                        ]
                    )?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

</div>
