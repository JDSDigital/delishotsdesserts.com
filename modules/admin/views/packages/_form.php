<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'packageImage')->fileInput() ?>

    <?= $form->field($model, 'type_id')->dropDownList($model->getTypes()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
      ]) ?>
      <?= Html::a(Yii::t('app', 'volver'), ['index'], [
          'class' => 'btn btn-danger',
      ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
