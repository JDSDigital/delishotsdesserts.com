<?php

namespace app\controllers;

use app\models\Option;
use app\models\Products;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

class OptionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays Option Index Page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return null|string
     */
    public function actionProducts()
    {
        if (Yii::$app->request->isAjax) {
            $products = Products::find()->where(['status' => Products::STATUS_ACTIVE])->asArray()->all();
            $products = ArrayHelper::map($products, 'id', 'name');
            return json_encode($products);
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductthumb()
    {
        if (Yii::$app->request->isAjax) {
            $product = Products::findOne(Yii::$app->request->post()['id']);
            return $product->product . '.jpg';
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductforms()
    {
        if (Yii::$app->request->isAjax) {
            $product = Products::findOne(Yii::$app->request->post()['id']);
            $response = [];
            if ($product->priceFull != null && $product->priceFull != '')
                $response[Products::PRODUCT_FULL] = 'Postre Completo';
            if ($product->priceShot != null && $product->priceShot != '')
                $response[Products::PRODUCT_SHOT] = 'Shots';
            if ($product->price5oz != null && $product->price5oz != '')
                $response[Products::PRODUCT_5OZ] = 'Vasito de 5oz';
            if ($product->price8oz != null && $product->price8oz != '')
                $response[Products::PRODUCT_8OZ] = 'Vasito de 8oz';
            return json_encode($response);
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductquantities()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            return json_encode(Products::PRODUCT_QUANTITIES[$data['id']]);
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductprice()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $product = Products::find()
                ->where(['id' => $data['product']])
                ->asArray()
                ->one();
            $price = $product[Products::PRODUCT_FORMS[$data['form']]] * $data['quantity'];
            return json_encode(Yii::$app->formatter->asCurrency($price, 'VEF'));
        } else
            return null;
    }
}
