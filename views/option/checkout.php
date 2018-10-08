<?php

/**
 * @var $this yii\web\View
 * @var $option Option
 **/

use app\models\Option;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Checkout';
?>
<div class="site-option">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
</div>

    <table class="table-responsive table table-striped table-hover">
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
        </thead>
        <tbody id="options-table-body">
            <?php foreach ($cart['items'] as $item) : ?>
              <tr>
                <td>
                  <?= Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $item['product'] . '.jpg', ['class' => 'img-responsive']) ?>
                </td>
                <td>
                  <?= $item['name'] ?>
                </td>
                <td>
                  <?= $item['form']?>
                </td>
                <td>
                  <?= $item['quantity']?>
                </td>
                <td>
                  <?= ($item['box']) ? Html::img(Yii::getAlias('@web') . '/images/packages/' . $item['box'] . '.jpg') : 'Sin Empaque' ?>
                </td>
                <td>
                  <?= Yii::$app->formatter->asCurrency($item['boxPrice'], 'VEF') . 'c/u' ?>
                </td>
                <td>
                  <?= Yii::$app->formatter->asCurrency($item['boxTotal'], 'VEF') ?>
                </td>
                <td>
                  <?= Yii::$app->formatter->asCurrency($item['price'], 'VEF') . 'c/u' ?>
                </td>
                <td>
                  <?= Yii::$app->formatter->asCurrency($item['priceTotal'], 'VEF') ?>
                </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<div class="container">
  <div class="site-option">
    <div class="row text-center">
        <h2><strong>Total: </strong> <?= Yii::$app->formatter->asCurrency($cart['total'], 'VEF') ?></h2>
    </div>
    <div class="row text-center">
        <?= Html::a('Enviar Pedido', ['/option/form'], ['id' => 'button-form', 'url' => Url::to(['/option/form']),'class' => 'btn btn-success btn-check']) ?>
    </div>
</div>
