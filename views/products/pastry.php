<?php

/* @var $this yii\web\View */
/* @var $products */

use yii\helpers\Html;

$this->title = 'Nuestros Productos';
?>
<div class="site-pastry">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row vertical-align">
        <div class="col-md-6 text-justify">
            <p>Elaboramos diseños para cualquier tipo de evento como matrimonios, bautizos, primera comunión, aniversarios y fiestas infantiles, donde mezclamos una gran variedad de productos tortas decoradas, gelatinas, cupcakes, galletas, entre otros, siendo un gran reto para nosotros presentar a nuestros clientes diseños espectaculares, visualmente llamativos y con un gran sabor.</p>
        </div>
        <div class="col-md-6">
            <?= Html::img(Yii::getAlias('@web') . '/images/products/full/pastry02.jpg', [
                'class' => 'img-fluid m0a animated fadeInUp',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        </div>
    </div>
</div>
<div class="site-pastry">
    <div class="row vertical-align">
        <div class="col-md-4">
            <?= Html::img(Yii::getAlias('@web') . '/images/products/full/pastry05.jpg', [
                'class' => 'img-fluid m0a animated fadeInUp',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        </div>
        <div class="col-md-8 text-justify">
            <p>Nuestro objetivo es lograr productos estéticamente atractivos, que deslumbren el paladar al probarlo y que permanezca sin refrigeración manteniendo su frescura y belleza.</p>
            <p>Cuando elaboramos un proyecto nos reunimos con nuestros clientes para escuchar e interpretar sus ideas, descubrimos sus gustos y sus aspiraciones, posteriormente estudiamos todos los aspectos importantes y desarrollamos un proyecto adaptado a sus necesidades.</p>
            <p>Consulta sin compromiso y te presentaremos varias alternativas.</p>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><?= Html::a('Contáctanos para mayor información', ['site/contact'] ) ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
