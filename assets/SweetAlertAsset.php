<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Sweet Alert files.
 */
class SweetAlertAsset extends AssetBundle
{
	public $sourcePath = '@bower/sweetalert2/dist';
	public $css = [
		'sweetalert2.min.css',
	];
	public $js = [
		'sweetalert2.min.js',
	];
}
