<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="header text-center">
        <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
            'class'          => 'img-fluid m0a',
            'data-wow-delay' => '0.5s',
            'alt'            => Html::encode('Delishots & Desserts'),
        ]) ?>
    </div>
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-center'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer-left">
                    <div class="col-xs-6">
                        <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
                            'class'          => 'img-fluid logo-footer m0a',
                            'data-wow-delay' => '0.5s',
                            'alt'            => Html::encode('Delishots & Desserts'),
                        ]) ?>
                    </div>
                    <div class="col-xs-6 text-left footer-contact">
                        <p><?= Html::encode('+58 212 668 4108') ?></p>
                        <p><?= Html::encode('tequemucho@gmail.com') ?></p>
                    </div>
                </div>
                <div class="col-md-6 footer-right text-center">
                    <h5>¡Síguenos en nuestras redes sociales!</h5>
                    <a class="btn btn-instagram" href="https://www.instagram.com/tequemucho/" target="_blank"><i class="fa fa-lg fa-instagram"></i></a>
                    <a class="btn btn-twitter" href="https://twitter.com/tequemucho" target="_blank"><i class="fa fa-lg fa-twitter"></i></a>
                    <a class="btn btn-facebook" href="https://es-la.facebook.com/Tequemucho/" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-rights">
        <div class="container">
            <p>© <?= date('Y') ?> Tequeño Mucho. Todos los derechos reservados.</p>
            <p>Creado por <a href="https://github.com/JDSDigital" target="_blank">JDSDigital</a></p>
            <p>
                <a href="https://github.com/JDSDigital" target="_blank">
                    <?= Html::img(Yii::getAlias('@web') . '/images/GitHub-Mark-Light-32px.png') ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
