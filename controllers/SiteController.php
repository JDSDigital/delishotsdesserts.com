<?php

namespace app\controllers;

use app\models\Products;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
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
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['//admin/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('index');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->contact())
                Yii::$app->session->setFlash('success', 'Gracias por contactarnos. Te responderemos lo mas pronto posible.');
            else
                Yii::$app->session->setFlash('error', 'Ocurrió un error con el envío de su correo. Por favor intente mas tarde.');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionProducts()
    {
        $products = new Products();

        return $this->render('products', [
            'products' => $products->getProducts(),
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionProductView()
    {
        $products = new Products();

        return $this->render('product', [
            'products' => $products->getProducts(),
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionGallery()
    {
        return $this->render('gallery');
    }

    /**
     * Displays admin page.
     *
     * @return string
     */
    public function actionAdmin()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('admin');
    }

}
