<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$class = (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'wrap index-slider' : 'wrap';
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::getAlias('@web') . '/images/favicon.png']);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Oxygen:300,400,700" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="preloader">

    <div id="preloader" class="text-center">
        <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
            'id'    => 'spinner',
            'class' => 'img-fluid m0a',
            'alt'   => Html::encode('Delishots & Desserts'),
        ]) ?>
    </div>

<?php $this->beginBody() ?>

<div class="<?= $class ?>">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-center'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Quienes Somos', 'url' => ['/site/about']],
            ['label' => 'Nuestros Productos', 'url' => ['/products/index']],
            ['label' => 'Escoge tu Mejor Opción', 'url' => ['/site/option']],
            ['label' => 'Galería', 'url' => ['/gallery/index']],
            ['label' => 'Contáctanos', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="header text-center">
        <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>

        <?php } else { ?>
            <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
                'class' => 'img-fluid logo-banner m0a animated fadeIn',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        <?php } ?>
    </div>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>
<?php } else { ?>
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 footer-left">
                        <div class="col-xs-6">
                            <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
                                'class' => 'img-fluid logo-footer m0a',
                                'alt'   => Html::encode('Delishots & Desserts'),
                            ]) ?>
                        </div>
                        <div class="col-xs-6 text-left footer-contact">
                            <p><?= Html::encode('+58 0424 277 7546') ?></p>
                            <p><?= Html::encode('+58 0424 278 8219') ?></p>
                            <p><?= Html::encode('delishotsdesserts@gmail.com') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 footer-right text-center">
                        <h5>¡Síguenos en nuestras redes sociales!</h5>
                        <a class="btn btn-instagram" href="https://www.instagram.com/delishots/" target="_blank"><i class="fa fa-lg fa-instagram"></i></a>
                        <a class="btn btn-twitter" href="https://twitter.com/delishots" target="_blank"><i class="fa fa-lg fa-twitter"></i></a>
                        <a class="btn btn-facebook" href="https://es-la.facebook.com/delishots/" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-rights">
            <div class="container">
                <hr/>
                <p>© <?= date('Y') ?> Delishots Desserts. Todos los derechos reservados.</p>
                <p>Creado por <a href="https://github.com/JDSDigital" target="_blank">JDSDigital</a></p>
                <p>
                    <a href="https://github.com/JDSDigital" target="_blank">
                        <?= Html::img(Yii::getAlias('@web') . '/images/GitHub-Mark-Light-32px.png') ?>
                    </a>
                </p>
            </div>
        </div>
    </footer>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
