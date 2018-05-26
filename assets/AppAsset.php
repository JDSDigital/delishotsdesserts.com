<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/master.css',
        'css/mdb.min.css',
        'css/animate.css',
        'css/vegas.min.css',
        'css/font-awesome.min.css',
        'css/jquery.fancybox.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/mdb.min.js',
        'js/vegas.min.js',
        'js/parallax.min.js',
        'js/jquery.fancybox.min.js',
        // 'js/options.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\SweetAlertAsset',
    ];
}
