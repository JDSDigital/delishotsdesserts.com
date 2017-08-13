<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Galería';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?=
                Html::a(
                    '<div class="gallery-products m0a"><h2>' . Html::encode('Productos') . '</h2></div>',
                    ['gallery/products']
                );
            ?>
        </div>
        <div class="col-md-6">
            <?=
            Html::a(
                '<div class="gallery-events m0a"><h2>' . Html::encode('Eventos') . '</h2></div>',
                ['gallery/events']
            );
            ?>
        </div>
    </div>

</div>
