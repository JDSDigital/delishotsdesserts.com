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
        $products = new Products;
        $products->getProductsArray();

        return $this->render('index');
    }

    /**
     * @return null|string
     */
    public function actionProductsfull()
    {
        if (Yii::$app->request->isAjax) {
            $products = Yii::$app->session->get('products');
            $boxes = Yii::$app->session->get('boxes');
            $response = [
              'products' => $products,
              'boxes' => $boxes,
            ];
            return json_encode($response);
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProducts()
    {
        if (Yii::$app->request->isAjax) {
            $products = Yii::$app->session->get('products');
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
            $product = Yii::$app->session->get('products')[Yii::$app->request->post()['id']];
            return $product['product'] . '.jpg';
        } else
            return null;
    }

    /**
     * @return null|string
     */
    public function actionProductforms()
    {
        if (Yii::$app->request->isAjax) {
            $product = Yii::$app->session->get('products')[Yii::$app->request->post()['id']];
            $response = [];

            if ($product['type'] == Products::PRODUCT_BAKERY) {

                $response[0] =  Products::PRODUCT_BAKERY;

                if ($product['priceSlice'] != null && $product['priceSlice'] != '')
                    $response[Products::PRODUCT_SLICE] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_SLICE];

                if ($product['priceGlass'] != null && $product['priceGlass'] != '')
                    $response[Products::PRODUCT_GLASS] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_GLASS];

                if ($product['priceFull'] != null && $product['priceFull'] != '')
                    $response[Products::PRODUCT_FULL] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_FULL];

                if ($product['priceShot'] != null && $product['priceShot'] != '')
                    $response[Products::PRODUCT_SHOT] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_SHOT];

                if ($product['price5oz'] != null && $product['price5oz'] != '')
                    $response[Products::PRODUCT_5OZ] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_5OZ];

                if ($product['price8oz'] != null && $product['price8oz'] != '')
                    $response[Products::PRODUCT_8OZ] = Products::PRODUCT_FORMS_LABEL[Products::PRODUCT_8OZ];

            } elseif ($product['type'] == Products::PRODUCT_DELI)
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
            $product = Yii::$app->session->get('products')[$data['product']];

            // Price by unity
            $price = $product[Products::PRODUCT_FORMS[$data['form']]];

            // Price by quantity
            $priceTotal = $product[Products::PRODUCT_FORMS[$data['form']]] * $data['quantity'];

            $response = [
              'price' => Yii::$app->formatter->asCurrency($price, 'VEF') . ' c/u',
              'priceTotal' => Yii::$app->formatter->asCurrency($priceTotal, 'VEF')
            ];

            return json_encode($response);
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
            $product = Yii::$app->session->get('products')[$data['product']];

            $price = $product['priceDeli'];
            $priceTotal = $product['priceDeli'] * $data['quantity'];

            $response = [
              'price' => Yii::$app->formatter->asCurrency($price, 'VEF') . ' c/u',
              'priceTotal' => Yii::$app->formatter->asCurrency($priceTotal, 'VEF')
            ];

            return json_encode($response);
        } else
            return null;
    }

    public function actionCalculateTotal($data)
    {
        $total = 0;

        foreach ($data['list'] as $item) {
            $product = Yii::$app->session->get('products')[$item[0]];

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
                $product = Yii::$app->session->get('products')[$item[0]];

                array_push($list, [
                  'product' => $product['product'],
                  'name' => $product['name'],
                  'form' => ($item[1]) ? Products::PRODUCT_FORMS_LABEL[$item[1]] : null,
                  'box' => Products::PRODUCT_BOXES[$item[3]],
                  'price' => ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] : $product['priceDeli'],
                  'priceTotal' => ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] * $item[2] : $product['priceDeli'] * $item[2],
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
