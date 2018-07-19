<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Packages;
use app\models\search\PackagesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PackagesController implements the CRUD actions for Packages model.
 */
class PackagesController extends Controller
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
                      'actions' => ['logout', 'index', 'view', 'update', 'create', 'delete', 'status'],
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

    /**
     * Lists all Packages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Packages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Packages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Packages();

        if ($model->load(Yii::$app->request->post())) {
            $model->packageImage = UploadedFile::getInstance($model, 'packageImage');

            if ($model->packageImage && $model->uploadImage()) {
                $model->packageImage = null;
            }

            if ($model->save()) {

              Yii::$app->session->setFlash('success', 'Empaque creado exitosamente.');
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
     * Updates an existing Packages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $model->packageImage = UploadedFile::getInstance($model, 'packageImage');

          if ($model->packageImage && $model->uploadImage()) {
              $model->packageImage = null;
          }

          if ($model->save()) {

            Yii::$app->session->setFlash('success', 'Empaque actualizado exitosamente.');
            return $this->redirect(['index']);

          } else {

            foreach ($model->errors as $error) {
              Yii::$app->session->setFlash('error', $error);
            }

          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Packages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Changes Products Status.
     *
     * @return string
     */
    public function actionStatus()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = Packages::findOne($data['id']);

            if ($model->status)
                $model->status = Packages::STATUS_DELETED;
            else
                $model->status = Packages::STATUS_ACTIVE;

            $model->save();
        }

        return null;
    }

    /**
     * Finds the Packages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Packages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
