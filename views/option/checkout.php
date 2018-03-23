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

    <p>Checkout</p>

    <?php
      echo '<pre>';
      print_r($cart);
      echo '</pre>';
      exit;
     ?>

</div>
