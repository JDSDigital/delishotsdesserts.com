<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PackagesTypes */

$this->title = 'Create Packages Types';
$this->params['breadcrumbs'][] = ['label' => 'Packages Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
