<?php

use yii\helpers\Html;

$this->title = 'Actualizar Producto: ' . $model->name;
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>