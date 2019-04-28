<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Gallery;

class GalleryController extends \yii\web\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'products'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => false,
                        'roles'   => ['?'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('index');
    }

    public function actionProducts()
    {
        $models = Gallery::getGalleryProducts();

        $previews = [];
        $previewsConfig = [];

        foreach ($models as $image){
            $previews[] = $image->getThumb();

            $previewsConfig[] = [
              'caption' => $image->file,
              'key' => $image->id,
            //   'url' => Url::to(["/Social/social/deleteimage?id=" . $image->id]),
            ];
        }

        // if ($model->load(Yii::$app->request->post())) {

        //   if ($model->save()) {

        //     $model->upload();

        //     return $this->redirect(['view', 'id' => $model->id]);
        //   }
        // }

        return $this->render('update', [
            'models' => $models,
            'previews' => $previews,
            'previewsConfig' => $previewsConfig,
        ]);
    }

}
