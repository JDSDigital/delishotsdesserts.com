<?php

/**
 * @var $this yii\web\View
 * @var $option Option
 **/

use app\models\Option;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Escoge tu mejor opción';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-option">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Aquí podrás presupuestar tu pedido</p>

    <?php $form = ActiveForm::begin([
      'id' => 'option-form',
    ]); ?>
</div>
</div>

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
                  Empaque
                </th>
                <th>
                    Precio Empaque Individual
                </th>
                <th>
                    Precio Empaque Total
                </th>
                <th>
                    Precio Unitario
                </th>
                <th>
                    Precio Total
                </th>
                <th>
                    Eliminar
                </th>
            </thead>
            <tbody id="options-table-body">

            </tbody>
        </table>
    </div>

<div class="container">
  <div class="site-option">
    <div class="row">
        <div class="col-sm-12 text-right">
            <h4 id="price-total"></h4>
        </div>
    </div>
    <div class="row text-center">
        <?= Html::button('Click para agregar un producto', ['id' => 'button-add', 'class' => 'btn btn-add']) ?>
        <br />
        <?= Html::button('Revisar pedido', ['id' => 'button-check', 'url' => Url::to(['/option/checkout']),'class' => 'btn btn-success btn-check dn']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile('@web/js/options.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
