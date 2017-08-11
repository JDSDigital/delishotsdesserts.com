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

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'subject') ?>
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-submit', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-5 col-lg-offset-2 contact-details">
                <div class="row">
                    <i class="fa fa-lg fa-map-marker"></i><h4><?= Html::encode('Caracas, Venezuela') ?></h4>
                </div>
                <div class="row">
                    <i class="fa fa-lg fa-mobile"></i><h4><?= Html::encode('+58 0424 277 7546') ?></h4>
                </div>
                <div class="row">
                    <i class="fa fa-lg fa-mobile"></i><h4><?= Html::encode('+58 0424 278 8219') ?></h4>
                </div>
                <div class="row">
                    <i class="fa fa-lg fa-envelope"></i><h4><?= Html::encode('delishotsdesserts@gmail.com') ?></h4>
                </div>
                <div class="row social-icons">
                    <a class="btn btn-instagram" href="https://www.instagram.com/delishots/" target="_blank" style="margin-left:0"><i class="fa fa-lg fa-instagram"></i></a>
                    <a class="btn btn-twitter" href="https://twitter.com/delishots" target="_blank"><i class="fa fa-lg fa-twitter"></i></a>
                    <a class="btn btn-facebook" href="https://es-la.facebook.com/delishots/" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>
