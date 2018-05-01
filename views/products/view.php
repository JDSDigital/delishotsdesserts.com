<?php

/* @var $this yii\web\View */
/* @var $product */
/* @var $id */

use yii\helpers\Html;

$this->title = 'Nuestros Productos';

$i = 1;
?>
<div class="site-product">
    <div class="row">
        <div class="col-md-4 col-xs-6 col-md-offset-0 col-xs-offset-3">
            <?= Html::img(Yii::getAlias('@web') . '/images/products/full/' . $product->product . '.jpg', [
                'class' => 'img-responsive',
            ]) ?>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h1><?= $product->name ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><?= $product->description ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><?= Html::encode('Comparte este postre en las redes sociales') ?></h3>
                    <a class="btn btn-twitter" href="#" target="_blank"><i class="fa fa-lg fa-twitter"></i></a>
                    <a class="btn btn-facebook" href="#" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><?= Html::a('Solicita información sobre este servicio', ['site/contact'] ) ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <h4><?= Html::a('Volver', ['products/bakery'], ['class' => 'btn btn-submit mt30'] ) ?></h4>
      </div>
    </div>
</div>
