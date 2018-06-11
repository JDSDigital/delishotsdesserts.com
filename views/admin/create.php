<?php

use yii\helpers\Html;

$this->title = 'Crear Nuevo Producto';
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
