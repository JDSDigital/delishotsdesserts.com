<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

$this->registerMetaTag(['name' => 'author', 'content' => 'JDSDigital']);
$this->registerMetaTag(['rel' => 'canonical', 'href' => 'http://www.delishotsdessers.com']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Empresa dedicada a la elaboración casera de postres para eventos, fiestas, mayor y detal en la zona de Caracas.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'postres, eventos, fiestas, shots']);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => Url::to(['/site/index'], true)
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'website'
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => 'Delishots Desserts'
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => 'Empresa dedicada a la elaboración casera de postres para eventos, fiestas, mayor y detal en la zona de Caracas.'
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => Url::to(['/images/logo.png'], true)
]);

$this->registerMetaTag([
    'property' => 'og:image:alt',
    'content' => 'Delishots Desserts'
]);

$this->registerMetaTag([
    'property' => 'twitter:card',
    'content' => 'summary'
]);

$this->registerMetaTag([
    'property' => 'twitter:description',
    'content' => 'Empresa dedicada a la elaboración casera de postres para eventos, fiestas, mayor y detal en la zona de Caracas.'
]);

$this->registerMetaTag([
    'property' => 'twitter:title',
    'content' => 'Delishots Desserts'
]);

// Favicon
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '196x196', 'href' => Yii::getAlias('@web') . '/images/favicon/favicon-196x196.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '96x96', 'href' => Yii::getAlias('@web') . '/images/favicon/favicon-96x96.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => Yii::getAlias('@web') . '/images/favicon/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => Yii::getAlias('@web') . '/images/favicon/favicon-16x16.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '128x128', 'href' => Yii::getAlias('@web') . '/images/favicon/favicon-128.png']);

$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '57x57', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-57x57.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '114x114', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-114x114.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '72x72', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-72x72.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '144x144', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-144x144.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '60x60', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-60x60.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '120x120', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-120x120.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '76x76', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-76x76.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon-precomposed', 'sizes' => '152x152', 'href' => Yii::getAlias('@web') . '/images/favicon/apple-touch-icon-152x152.png']);

$this->registerMetaTag(['name' => 'application-name', 'content' => 'Delishots Desserts']);
$this->registerMetaTag(['name' => 'msapplication-TileColor', 'content' => '#FFFFFF']);
$this->registerMetaTag(['name' => 'msapplication-TileImage', 'content' => './images/favicon/mstile-144x144.png']);
$this->registerMetaTag(['name' => 'msapplication-square70x70logo', 'content' => './images/favicon/mstile-70x70.png']);
$this->registerMetaTag(['name' => 'msapplication-square150x150logo', 'content' => './images/favicon/mstile-150x150.png']);
$this->registerMetaTag(['name' => 'msapplication-wide310x150logo', 'content' => './images/favicon/mstile-310x150.png']);
$this->registerMetaTag(['name' => 'msapplication-square310x310logo', 'content' => './images/favicon/mstile-310x310.png']);

$class = (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'wrap index-slider' : 'wrap';
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
    <!-- Facebook SDK -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    		var js, fjs = d.getElementsByTagName(s)[0];
    		if (d.getElementById(id)) return;
    		js = d.createElement(s); js.id = id;
    		js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
    		fjs.parentNode.insertBefore(js, fjs);
    	}(document, 'script', 'facebook-jssdk'));</script>
    <!-- / Facebook SDK -->
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
            // ['label' => 'Escoge tu Mejor Opción', 'url' => ['/option/index']],
            ['label' => 'Galería', 'url' => ['/gallery/index']],
            ['label' => 'Contáctanos', 'url' => ['/site/contact']],
            !Yii::$app->user->isGuest ? (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn logout-button']
                    )
                    . Html::endForm()
                    . '</li>'
                ) : ''
        ],
    ]);
    NavBar::end();
    ?>
    <div class="header text-center">
        <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>
            <?php /* TODO: Fix this */ ?>
        <?php } else { ?>
            <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
                'class' => 'img-fluid logo-banner m0a animated fadeIn',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        <?php } ?>
    </div>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>
    <?php /* TODO: Fix this */ ?>
<?php } else { ?>
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 footer-left">
                        <div class="col-md-6">
                            <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', [
                                'class' => 'img-fluid logo-footer m0a',
                                'alt'   => Html::encode('Delishots & Desserts'),
                            ]) ?>
                        </div>
                        <div class="col-md-6 text-left footer-contact">
                            <p><?= Html::encode('+58 0424 277 7546') ?></p>
                            <p><?= Html::encode('+58 0424 278 8219') ?></p>
                            <p><?= Html::encode('delishotsdesserts@gmail.com') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 footer-right text-center">
                        <h5>¡Síguenos en nuestras redes sociales!</h5>
                        <a class="btn btn-instagram" href="https://www.instagram.com/delishotsdesserts/" target="_blank"><i class="fa fa-lg fa-instagram"></i></a>
                        <!-- <a class="btn btn-twitter" href="https://twitter.com/delishots/" target="_blank"><i class="fa fa-lg fa-twitter"></i></a> -->
                        <a class="btn btn-facebook" href="https://www.facebook.com/DeliShots-Desserts-2101429316845708/" target="_blank"><i class="fa fa-lg fa-facebook"></i></a>
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
