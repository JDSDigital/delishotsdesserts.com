<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Escoge tu mejor opción';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-option">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Aquí podrás presupuestar tu pedido</p>

    <div id="options-list"></div>
    <div class="row text-center">
        <?= Html::button('Click para agregar un producto', ['id' => 'button-add', 'class' => 'btn btn-add']) ?>
    </div>

</div>
