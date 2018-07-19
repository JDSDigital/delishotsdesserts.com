<?php
use yii\helpers\Html;
$this->title = 'Administrador de Delishots Desserts'
?>

<div class="Admin-default-index">
    <h1><?= $this->title ?></h1>
    <h3>Elija una opción:</h3>
    <?= Html::a('Productos', ['//admin/products'], ['class' => 'btn btn-admin']) ?>
    <?= Html::a('Empaques', ['//admin/packages'], ['class' => 'btn btn-admin']) ?>
</div>
