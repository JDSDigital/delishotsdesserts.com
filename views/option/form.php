<?php

/**
 * @var $this yii\web\View
 * @var $option Option
 **/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Introduzca sus datos';
?>
<div class="site-option">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
      <div class="col-lg-8">
        <?php $form = ActiveForm::begin(['id' => 'option-form']); ?>

          <?= $form->field($model, 'name') ?>
          <?= $form->field($model, 'email') ?>
          <?= $form->field($model, 'body')->textarea() ?>

          <?= Html::submitButton('Enviar', ['class' => 'btn btn-submit btn-success', 'name' => 'form-button']) ?>

        <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>
