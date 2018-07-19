<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PackagesTypes */

$this->title = 'Update Packages Types: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Packages Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="packages-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>