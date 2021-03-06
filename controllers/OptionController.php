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

    public $defaultAction = 'redirect';

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

    public function actionRedirect()
    {
        return $this->redirect('option/index');
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
            $forms = Yii::$app->session->get('forms');
            $quantities = Yii::$app->session->get('quantities');
            $typequantities = Yii::$app->session->get('typequantities');
            $showprices = Yii::$app->session->get('showprices');

            $response = [
              'products' => $products,
              'boxes' => $boxes,
              'forms' => $forms,
              'quantities' => $quantities,
              'typequantities' => $typequantities,
              'showprices' => $showprices,
            ];

            return json_encode($response);
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
            $box = ($data['box'] != 0) ? Yii::$app->session->get('boxes')[$data['box']] : 0;

            // Price by unity
            $price = $product[Products::PRODUCT_FORMS[$data['form']]];
            $boxPrice = ($box != 0) ? $box['price'] : 0;

            // Price by quantity
            $priceTotal = $product[Products::PRODUCT_FORMS[$data['form']]] * $data['quantity'];
            $boxTotal = ($box != 0) ? ceil($data['quantity'] / $box['quantity']) * $box['price'] : 0;

            $response = [
              'boxPrice' => Yii::$app->formatter->asCurrency($boxPrice, 'VEF') . ' c/u',
              'boxTotal' => Yii::$app->formatter->asCurrency($boxTotal, 'VEF'),
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
            $box = ($data['box'] != 0) ? Yii::$app->session->get('boxes')[$data['box']] : 0;

            $price = $product['priceDeli'];
            $priceTotal = $product['priceDeli'] * $data['quantity'];

            $boxPrice = ($box != 0) ? $box['price'] : 0;
            $boxTotal = ($box != 0) ? ceil($data['quantity'] / $box['quantity']) * $box['price'] : 0;

            $response = [
              'boxPrice' => Yii::$app->formatter->asCurrency($boxPrice, 'VEF') . ' c/u',
              'boxTotal' => Yii::$app->formatter->asCurrency($boxTotal, 'VEF'),
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
            $box = ($item[3] != 0) ? Yii::$app->session->get('boxes')[$item[3]] : 0;

            $boxTotal = ($box != 0) ? ceil($item[2] / $box['quantity']) * $box['price'] : 0;

            $price = ($item[1]) ?
                ($product[Products::PRODUCT_FORMS[$item[1]]] * $item[2]) + $boxTotal :
                ($product['priceDeli'] * $item[2]) + $boxTotal;
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
            if (Yii::$app->session->has('cart')) {
                return $this->redirect('actionCheckout');
            }

            $option = new Option;
            $option->setCart(Yii::$app->request->post());

            // If session variable has been created, proceds to checkout
            if (Yii::$app->session->get('cart')) {
                return true;
            }

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
