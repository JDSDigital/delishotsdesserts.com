<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const PRODUCT_FULL = 1;
    const PRODUCT_SHOT = 2;
    const PRODUCT_5OZ = 3;
    const PRODUCT_8OZ = 4;

    const PRODUCT_BAKERY = 1;
    const PRODUCT_PASTRY = 2;
    const PRODUCT_DELI = 3;

    const PRODUCT_FORMS = [
        self::PRODUCT_FULL => 'priceFull',
        self::PRODUCT_SHOT => 'priceShot',
        self::PRODUCT_5OZ => 'price5oz',
        self::PRODUCT_8OZ => 'price8oz',
    ];

    const PRODUCT_FORMS_LABEL = [
        self::PRODUCT_FULL => 'Postre Completo',
        self::PRODUCT_SHOT => 'Shots',
        self::PRODUCT_5OZ => 'Vasito de 5oz',
        self::PRODUCT_8OZ => 'Vasito de 8oz',
    ];

    const PRODUCT_QUANTITIES = [
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
            [['status', 'priceFull', 'priceShot', 'price5oz', 'price8oz', 'priceDeli'], 'integer'],
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
            'priceFull'   => 'Precio Completo',
            'priceShot'   => 'Precio Shot',
            'price5oz'    => 'Precio 5oz',
            'price8oz'    => 'Precio 8oz',
            'priceDeli'   => 'Precio Individual',
            'status'      => 'Estado',
        ];
    }

}
