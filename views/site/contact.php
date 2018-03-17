<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contáctanos';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Gracias por contactarnos. Te responderemos lo mas pronto posible.
        </div>

    <?php else: ?>

        <p>
            ¿Tienes alguna duda? Nos encantaría escuchar de ti. Si quieres realizar un pedido haz click <?= Html::a('aquí', ['//option/index']) ?>.
        </p>

<div class="row">
  <div class="col-lg-8 col-lg-offset-2">
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <div class="row text-center social-icons" style="margin: 30px 0">
      <h3>¡Siguenos en nuestras redes sociales!</h3>
      <a class="btn btn-instagram" href="https://www.instagram.com/delishots/" target="_blank"><i class="fa fa-lg fa-instagram"></i></a>
      <a class="btn btn-twitter" href="https://twitter.com/delishots" target="_blank"><i class="fa fa-lg fa-twitter"></i></a>
      <a class="btn btn-facebook" href="https://es-la.facebook.com/delishots/" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
    </div>
    <div class="row" style="margin-bottom: 20px">
      <div class="col-lg-12">
        <h3>Formulario de contacto:</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
      </div>
      <div class="col-lg-6">
        <?= $form->field($model, 'email') ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
          'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
          ]) ?>

          <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-submit', 'name' => 'contact-button']) ?>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
  </div>
</div>

    <?php endif; ?>
</div>
