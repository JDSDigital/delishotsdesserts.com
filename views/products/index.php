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
        <?php foreach ($products as $product) : ?>

            <div class="col-md-3 product-container">
                <h2><?= $product['name'] ?></h2>
                <div class="view hm-zoom">
                    <?=
                        Html::a(
                            Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $product['product'] . '.jpg', ['class' => '']) . '<span></span>',
                            ['products/view', 'id' => $i]
                        );
                    ?>
                </div>
            </div>

            <?php if (($i+1) % 4 == 0) : ?>
<!--                </div><div class="row">-->
            <?php endif; ?>

            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
</div>
