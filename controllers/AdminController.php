<?php

namespace app\controllers;

use app\models\Products;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AdminController extends \yii\web\Controller
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
                        'actions' => ['logout', 'index', 'view', 'update', 'create', 'delete', 'productstatus'],
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

        $dataProviderBakery = new ActiveDataProvider([
            'query' => Products::find()->where(['type' => 1]),
        ]);

        $dataProviderDeli = new ActiveDataProvider([
            'query' => Products::find()->where(['type' => 3]),
        ]);

        return $this->render('index', [
            'dataProviderBakery' => $dataProviderBakery,
            'dataProviderDeli' => $dataProviderDeli,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Products::find()->where(['id' => $id])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->productImage = UploadedFile::getInstance($model, 'productImage');
            $model->productThumb = UploadedFile::getInstance($model, 'productThumb');

            if ($model->productImage && $model->uploadImage()) {
                $model->productImage = null;
            }

            if ($model->productThumb && $model->uploadThumb()) {
                $model->productThumb = null;
            }

            if ($model->save()) {

              return $this->redirect(['index']);

            } else {

              foreach ($model->errors as $error) {
                Yii::$app->session->setFlash('error', $error);
              }
              return $this->render('update', [
                  'model' => $model,
              ]);

            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Products;

        if ($model->load(Yii::$app->request->post())) {

          $model->productImage = UploadedFile::getInstance($model, 'productImage');
          $model->productThumb = UploadedFile::getInstance($model, 'productThumb');

          if ($model->productImage && $model->uploadImage()) {
              $model->productImage = null;
          }

          if ($model->productThumb && $model->uploadThumb()) {
              $model->productThumb = null;
          }

          if ($model->save()) {

            Yii::$app->session->setFlash('success', 'Producto creado exitosamente.');
            return $this->redirect(['index']);

          } else {

            foreach ($model->errors as $error) {
              Yii::$app->session->setFlash('error', $error);
            }

          }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Changes Products Status.
     *
     * @return string
     */
    public function actionProductstatus()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = Products::findOne($data['id']);

            if ($model->status)
                $model->status = Products::STATUS_DELETED;
            else
                $model->status = Products::STATUS_ACTIVE;

            $model->save();
        }

        return null;
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!unlink('images/products/full/' . $model->product . '.jpg'))
          Yii::$app->session->setFlash('error', 'Error al eliminar las fotos del producto');

        if (!unlink('images/products/thumbs/' . $model->product . '.jpg'))
          Yii::$app->session->setFlash('error', 'Error al eliminar las fotos del producto');

        if ($model->delete()) {
          Yii::$app->session->setFlash('success', 'Producto eliminado exitosamente.');
        } else {
          foreach ($model->errors as $error) {
            Yii::$app->session->setFlash('error', $error);
          }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
