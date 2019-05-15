<?php
use yii\helpers\Html;
$this->title = 'Administrador de la galería'
?>

<div class="Admin-default-index">
    <h1><?= $this->title ?></h1>
    <h3>Elija una opción:</h3>
    <?= Html::a('Productos', ['//admin/gallery/products'], ['class' => 'btn btn-admin']) ?>
    <?= Html::a('Eventos', ['//admin/gallery/events'], ['class' => 'btn btn-admin']) ?>
</div>