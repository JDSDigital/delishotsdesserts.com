<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const PRODUCT_SLICE = 1;
    const PRODUCT_GLASS = 2;
    const PRODUCT_FULL = 3;
    const PRODUCT_SHOT = 4;
    const PRODUCT_5OZ = 5;
    const PRODUCT_8OZ = 6;

    const PRODUCT_BAKERY = 1;
    const PRODUCT_PASTRY = 2;
    const PRODUCT_DELI = 3;

    const PRODUCT_FORMS = [
        self::PRODUCT_SLICE => 'priceSlice',
        self::PRODUCT_GLASS => 'priceGlass',
        self::PRODUCT_FULL => 'priceFull',
        self::PRODUCT_SHOT => 'priceShot',
        self::PRODUCT_5OZ => 'price5oz',
        self::PRODUCT_8OZ => 'price8oz',
    ];

    const PRODUCT_FORMS_LABEL = [
        self::PRODUCT_SLICE => 'Porción Individual',
        self::PRODUCT_GLASS => 'Envase de Vidrio',
        self::PRODUCT_FULL => 'Postre Completo Kg',
        self::PRODUCT_SHOT => 'Shots',
        self::PRODUCT_5OZ => 'Vasito de 5oz',
        self::PRODUCT_8OZ => 'Vasito de 8oz',
    ];

    const PRODUCT_QUANTITIES = [
        self::PRODUCT_SLICE => [1,2,3,4],
        self::PRODUCT_GLASS => [1,2,3,4],
        self::PRODUCT_FULL => [1,2,3,4],
        self::PRODUCT_SHOT => [20,30,40,50,60,70,80,90,100],
        self::PRODUCT_5OZ => [6,12,18,24,30,36,42,48,54,60],
        self::PRODUCT_8OZ => [6,12,18,24,30,36,42,48,54,60],
    ];

    const PRODUCT_TYPE_QUANTITIES = [
        self::PRODUCT_BAKERY => [],
        self::PRODUCT_PASTRY => [],
        self::PRODUCT_DELI => [12,24,36,48,60,72,84],
    ];

    const PRODUCT_BOXES = [
        '0' => '',
        self::PRODUCT_SLICE => 'Empaque Individual',
        self::PRODUCT_GLASS => 'Recipiente de Vidrio',
        self::PRODUCT_FULL => 'Caja Grande',
        self::PRODUCT_SHOT => 'Caja de 12',
        self::PRODUCT_5OZ => 'Caja de 12',
        self::PRODUCT_8OZ => 'Caja de 12',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_products';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['product', 'name', 'description'], 'string'],
            [['status', 'priceSlice', 'priceGlass', 'priceFull', 'priceShot', 'price5oz', 'price8oz', 'priceDeli'], 'integer'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'product'     => 'Producto',
            'name'        => 'Nombre',
            'description' => 'Descripción',
            'priceSlice'   => 'Porción Individual',
            'priceGlass'   => 'Envase de Vidrio',
            'priceFull'   => 'Precio Completo',
            'priceShot'   => 'Precio Shot',
            'price5oz'    => 'Precio 5oz',
            'price8oz'    => 'Precio 8oz',
            'priceDeli'   => 'Precio Individual',
            'status'      => 'Estado',
        ];
    }

    /**
     *  Sets a session variable with an array of active products
     *  @return array
     */
    public function getProductsArray()
    {
        if (Yii::$app->session->has('cart'))
            Yii::$app->session->remove('cart');

        if (Yii::$app->session->has('products'))
            Yii::$app->session->remove('products');

        if (Yii::$app->session->has('boxes'))
            Yii::$app->session->remove('boxes');

        $products = Products::find()
          ->where(['status' => Products::STATUS_ACTIVE])
          ->asArray()
          ->all();

        array_unshift($products, [0]);

        Yii::$app->session->set('products', $products);
        Yii::$app->session->set('boxes', self::PRODUCT_BOXES);

        return true;

    }

}
