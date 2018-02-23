<?php

/**
 * @var $this yii\web\View
 * @var $option Option
 **/

use app\models\Option;
use yii\helpers\Html;

$this->title = 'Escoge tu mejor opción';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-option">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Aquí podrás presupuestar tu pedido</p>

    <div id="options-list">
        <table id="options-table" class="table-responsive table table-striped table-hover">
            <thead>
                <th>
                    Foto
                </th>
                <th>
                    Producto
                </th>
                <th>
                    Presentación
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Eliminar
                </th>
            </thead>
            <tbody id="options-table-body">

            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <h4 id="price-total"></h4>
        </div>
    </div>
    <div class="row text-center">
        <?= Html::button('Click para agregar un producto', ['id' => 'button-add', 'class' => 'btn btn-add']) ?>
    </div>

</div>