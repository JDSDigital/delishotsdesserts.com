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
                Precio
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
                  <?= Yii::$app->formatter->asCurrency($item['price'], 'VEF') ?>
                </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row text-center">
        <h2><strong>Total: </strong> <?= Yii::$app->formatter->asCurrency($cart['total'], 'VEF') ?></h2>
    </div>
    <div class="row text-center">
        <?= Html::button('Enviar Pedido', ['id' => 'button-send', 'url' => Url::to(['/option/checkout']),'class' => 'btn btn-success btn-check']) ?>
    </div>
</div>
