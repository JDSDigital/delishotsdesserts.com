<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Galería';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <h2 class="gallery-image-text"><?= Html::encode('Productos')?></h2>
            <?=
                Html::a(
                    '<div class="gallery-products m0a"><span></span></div>',
                    ['gallery/products']
                );
            ?>
        </div>
        <div class="col-md-6">
            <h2 class="gallery-image-text"><?= Html::encode('Eventos')?></h2>
            <?=
            Html::a(
                '<div class="gallery-events m0a"><span></span></div>',
                ['gallery/events']
            );
            ?>
        </div>
    </div>

</div>
