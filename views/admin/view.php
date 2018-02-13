<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <?= Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $model->product . '.jpg', ['class' => 'img-responsive']); ?>
            </div>
        </div>

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'description',
                'priceFull',
                'priceShot',
                'price5oz',
                'price8oz',
            ],
        ]) ?>

    </div>
</div>