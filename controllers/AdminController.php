<?php

namespace app\controllers;

use app\models\Products;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

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
                        'actions' => ['logout', 'index', 'view', 'update'],
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
