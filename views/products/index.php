<?php

/* @var $this yii\web\View */
/* @var $products */

use yii\helpers\Html;

$this->title = 'Nuestros Productos';

$i = 0;
?>
<div class="site-products">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <h2 class="gallery-image-text"><?= Html::encode('Pastelería')?></h2>
            <?=
            Html::a(
                '<div class="gallery-bakery m0a"><span></span></div>',
                ['products/bakery']
            );
            ?>
        </div>
        <div class="col-md-6">
            <h2 class="gallery-image-text"><?= Html::encode('Repostería')?></h2>
            <?=
            Html::a(
                '<div class="gallery-pastry m0a"><span></span></div>',
                ['products/pastry']
            );
            ?>
        </div>
    </div>
</div>
