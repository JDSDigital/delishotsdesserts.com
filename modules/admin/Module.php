<?php

namespace app\modules\admin;

use yii;
use yii\helpers\FileHelper;

/**
 * Admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //$path = Yii::getAlias('@web') . '/images/packages';

        //FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
    }
}
