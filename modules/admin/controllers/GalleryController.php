<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
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
                        'actions' => ['index', 'products', 'events', 'deleteimage'],
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
        $model = new Gallery;
        
        if (Yii::$app->request->post()) {
            $model->upload(Gallery::GALLERY_PRODUCT);
        }
        
        $images = $model->getGalleryProducts();
        $previews = [];
        $previewsConfig = [];

        foreach ($images as $image){
            $previews[] = $image->getThumb();

            $previewsConfig[] = [
              'caption' => $image->file,
              'key' => $image->id,
              'url' => Url::to(["//admin/gallery/deleteimage?id=" . $image->id]),
            ];
        }

        return $this->render('update', [
            'model' => $model,
            'previews' => $previews,
            'previewsConfig' => $previewsConfig,
        ]);
    
    }

    public function actionEvents()
    {
        $model = new Gallery;
        
        if (Yii::$app->request->post()) {
            $model->upload(Gallery::GALLERY_EVENT);
        }
        
        $images = $model->getGalleryEvents();
        $previews = [];
        $previewsConfig = [];

        foreach ($images as $image){
            $previews[] = $image->getThumb();

            $previewsConfig[] = [
              'caption' => $image->file,
              'key' => $image->id,
              'url' => Url::to(["//admin/gallery/deleteimage?id=" . $image->id]),
            ];
        }

        return $this->render('update', [
            'model' => $model,
            'previews' => $previews,
            'previewsConfig' => $previewsConfig,
        ]);
    }

    /**
      * Deletes a single image
      * @param $id
      * @return bool
      */
    public function actionDeleteimage($id)
    {
        $image = Gallery::findOne($id);

        $url = $image->getFolder() . 'full-' . $image->file;
        $urlThumb = $image->getFolder() . 'thumb-' . $image->file;

        // Delete image from the database and the folder
        return (unlink($url) && unlink($urlThumb) && $image->delete()) ? true : false;
    }

}
