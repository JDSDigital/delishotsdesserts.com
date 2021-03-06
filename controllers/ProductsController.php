<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Products;
use app\models\search\ProductsSearch;

class ProductsController extends Controller
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionBakery()
    {
        $productsSearch = new ProductsSearch;
        $dataProvider = $productsSearch->getProducts(Yii::$app->request->post());

        return $this->render('bakery', [
            'products' => $dataProvider->getModels(),
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionPastry()
    {
        return $this->render('pastry');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionView($id)
    {
        $product = Products::findOne($id);

        return $this->render('view', [
            'product' => $product,
        ]);
    }

    /**
     * Sets flash and redirects to contact
     *
     * @return string
     */
    public function actionContact()
    {
        Yii::$app->session->set('pastry', true);

        return $this->redirect(['site/contact']);
    }
}
