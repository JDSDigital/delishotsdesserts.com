<?php

use app\models\Products;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?= Html::img(Yii::getAlias('@web') . '/images/products/thumbs/' . $model->product . '.jpg', ['class' => 'img-responsive m0a']); ?>
            </div>
        </div>

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?= ($model->type == Products::PRODUCT_BAKERY) ?
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description',
                    'priceSlice',
                    'priceGlass',
                    'priceFull',
                    'priceShot',
                    'price5oz',
                    'price8oz',
                ],
            ]) :
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description',
                    'priceDeli',
                ],
            ])

        ?>

    </div>
</div>
