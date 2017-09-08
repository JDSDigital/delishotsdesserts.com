<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Quienes Somos';
?>
<div class="site-about">
    <div class="row">
        <div class="col-md-3 col-xs-6 col-md-offset-0 col-xs-offset-3">
            <?= Html::img(Yii::getAlias('@web') . '/images/product1.jpg', [
                'class' => 'img-responsive m0a animated fadeInUp',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        </div>
        <div class="col-md-9 col-xs-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= Html::encode('Comenzamos elaborando postres caseros para eventos familiares, con recetas que han pasado de generación en generación, al pasar el tiempo fuimos recopilando nuevas recetas y aumentando nuestro repertorio, obteniendo un alto nivel de aceptación de amigos y familiares, esto representó un gran incentivo y nos vimos en la necesidad de tomar la decisión de crear una pequeña empresa de todo lo que veníamos haciendo, planteándonos la mejor forma de presentar nuestros postres y el tipo de mercado que atenderíamos. Así se formó Delishot & Desserts, la cual es una empresa familiar dedicada a la elaboración de postres con diferentes presentaciones para todo tipo de eventos y reuniones.') ?></p>

            <h1><?= Html::encode('Misión') ?></h1>
            <p><?= Html::encode('Dedicarnos a la fabricación de los mejores postres del mercado.') ?></p>

            <h1><?= Html::encode('Visión') ?></h1>
            <p><?= Html::encode('Ser una empresa líder en el mercado, reconocida por su calidad y responsabilidad.') ?></p>

        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <h6><?= Html::encode('"Pruébalos y nunca nos dejarás".') ?></h6>
        </div>
    </div>
</div>
