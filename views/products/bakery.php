<?php

/* @var $this yii\web\View */
/* @var $products */

use yii\helpers\Html;

$this->title = 'Nuestros Productos';

?>
<div class="site-products">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">

        <?php foreach ($products as $product) : ?>
            <div class="col-md-3 product-container">
                <h2><?= $product->name ?></h2>
                <div class="view hm-zoom">
                    <?=
                        Html::a(
                            Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $product->product . '.jpg', ['class' => '']) . '<span></span>',
                            ['products/view', 'id' => $product->id]
                        );
                    ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
