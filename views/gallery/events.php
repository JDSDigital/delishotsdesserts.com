<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Galería de Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach($models as $image) : ?>
            <div class="col-sm-3">
                <div class="view hm-zoom">
                    <?= Html::a(
                        Html::img(Yii::getAlias('@web') . '/images/gallery/events/thumb-' . $image->file, [
                            'class' => 'crop-gallery',
                            'alt'   => Html::encode('Delishots Desserts'),
                        ]),
                        Yii::getAlias('@web') . '/images/gallery/events/full-' . $image->file,
                        [
                            'data-fancybox' => "gallery",
                            'data-caption'  => "Delishots Desserts",
                        ]
                    )?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row site-product">
      <div class="col-md-12 text-center">
        <h4><?= Html::a('Volver a Galería', ['gallery/index'], ['class' => 'btn btn-submit mt30'] ) ?></h4>
      </div>
    </div>

</div>
