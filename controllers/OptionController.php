<?php

namespace app\controllers;

use app\models\Option;
use app\models\OptionForm;
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
        if (Yii::$app->session->has('cart'))
            Yii::$app->session->remove('cart');

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

            if ($product->type == Products::PRODUCT_BAKERY) {

                $response[0] =  Products::PRODUCT_BAKERY;

                if ($product->priceFull != null && $product->priceFull != '')
                    $response[Products::PRODUCT_FULL] = 'Postre Completo';
                if ($product->priceShot != null && $product->priceShot != '')
                    $response[Products::PRODUCT_SHOT] = 'Shots';
                if ($product->price5oz != null && $product->price5oz != '')
                    $response[Products::PRODUCT_5OZ] = 'Vasito de 5oz';
                if ($product->price8oz != null && $product->price8oz != '')
                    $response[Products::PRODUCT_8OZ] = 'Vasito de 8oz';
            } elseif ($product->type == Products::PRODUCT_DELI)
                $response[0] =  Products::PRODUCT_DELI;

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
            if ($data['id'] != 0)
                return json_encode(Products::PRODUCT_QUANTITIES[$data['id']]);
            else
                return json_encode(Products::PRODUCT_TYPE_QUANTITIES[Products::PRODUCT_DELI]);
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

            // Price by quantity
            //$price = $product[Products::PRODUCT_FORMS[$data['form']]] * $data['quantity'];

            // Price by unity
            $price = $product[Products::PRODUCT_FORMS[$data['form']]];

            return json_encode(Yii::$app->formatter->asCurrency($price, 'VEF') . ' c/u');
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductpricedeli()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $product = Products::find()
                ->where(['id' => $data['product']])
                ->asArray()
                ->one();
            $price = $product['priceDeli'] * $data['quantity'];
            return json_encode(Yii::$app->formatter->asCurrency($price, 'VEF'));
        } else
            return null;
    }

    public function actionCalculateTotal($data)
    {
        $total = 0;

        foreach ($data['list'] as $item) {
            $product = Products::find()
                ->where(['id' => $item[0]])
                ->asArray()
                ->one();
            $price = ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] * $item[2] : $product['priceDeli'] * $item[2];
            $total = $total + $price;
        }
        return $total;
    }

    /**
     * @return null|string
     */
    public function actionTotalprice()
    {
        if (Yii::$app->request->isAjax) {
            $total = $this->actionCalculateTotal(Yii::$app->request->post());
            return json_encode('<b>Total: </b>' . Yii::$app->formatter->asCurrency($total, 'VEF'));
        } else
            return null;
    }

    public function actionSetcart()
    {
        // If request doesnt come from ajax, does nothing
        if (Yii::$app->request->isAjax) {

            // If there is already a cart, proceeds to checkout
            if (Yii::$app->session->has('cart'))
                return $this->redirect('actionCheckout');

            $cart = [];
            $list = [];
            $data = Yii::$app->request->post();

            // Creates an array with the clients products
            foreach ($data['list'] as $item) {
                $product = Products::find()
                    ->where(['id' => $item[0]])
                    ->asArray()
                    ->one();

                array_push($list, [
                  'product' => $product['product'],
                  'name' => $product['name'],
                  'form' => ($item[1]) ? Products::PRODUCT_FORMS_LABEL[$item[1]] : null,
                  'price' => ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] * $item[2] : $product['priceDeli'] * $item[2],
                  'quantity' => $item[2],
                ]);
            }

            // Adds products and total to response array
            $cart['items'] = $list;
            $cart['total'] = $this->actionCalculateTotal($data);

            // Sets the response array as a session variable
            Yii::$app->session->set('cart', $cart);

            // If session variable has been created, proceds to checkout
            if (Yii::$app->session->get('cart'))
                return true;

        } else
            return null;

    }

    public function actionCheckout()
    {
        if (!Yii::$app->session->has('cart'))
            return $this->redirect('actionIndex');

        $cart = Yii::$app->session->get('cart');

        return $this->render('checkout', [
            'cart' => $cart,
        ]);
    }

    public function actionForm()
    {
        if (!Yii::$app->session->has('cart'))
            return $this->redirect('actionIndex');

        $model = new OptionForm;

        if ($model->load(Yii::$app->request->post()) && $model->sendMail()) {
            Yii::$app->session->setFlash('success', 'Su pedido ha sido enviado. Le contactaremos lo antes posible.');
            return $this->redirect(['//site/index']);
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }
}
