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
                <div class="view hm-zoom">
                  <h2>
                    <?=
                    Html::a(
                      $product->name,
                      ['products/view', 'id' => $product->id],
                      ['class' => 'product-link']
                    );
                    ?>
                  </h2>
                    <?=
                        Html::a(
                            Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $product->product . '.jpg', ['class' => 'crop']) . '<span></span>',
                            ['products/view', 'id' => $product->id]
                        );
                    ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="row site-product">
      <div class="col-md-12 text-center">
        <h4><?= Html::a('Volver a Nuestros Productos', ['products/index'], ['class' => 'btn btn-submit mt30'] ) ?></h4>
      </div>
    </div>
</div>
