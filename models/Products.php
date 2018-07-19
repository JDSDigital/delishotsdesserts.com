<?php

namespace app\models;

use app\models\Packages;
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
    const PRODUCT_MIX = 4;

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

    public $forms = [];

    public $productImage;
    public $productThumb;

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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
          $product = strtolower($this->name);
          $product = str_replace(' ', '-', $product);
          $this->product = $product;
        }

        return true;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['product', 'name', 'description'], 'string'],
            [['type', 'status', 'priceSlice', 'priceGlass', 'priceFull', 'priceShot', 'price5oz', 'price8oz', 'priceDeli'], 'integer'],

            [['productImage', 'productThumb'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'productImage'     => 'Imagen Completa',
            'productThumb'     => 'Imagen en Miniatura',
            'product'     => 'Producto',
            'name'        => 'Nombre',
            'description' => 'Descripción',
            'type'        => 'Tipo',
            'priceSlice'  => 'Porción Individual',
            'priceGlass'  => 'Envase de Vidrio',
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

        $boxes = Packages::find()
          ->select(['id', 'type_id', 'name', 'price', 'status'])
          ->where(['status' => Packages::STATUS_ACTIVE])
          ->asArray()
          ->all();

        array_unshift($products, [0]);

        Yii::$app->session->set('products', $products);
        Yii::$app->session->set('boxes', $boxes);

        return true;

    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->isNewRecord) {
              $product = strtolower($this->name);
              $product = str_replace(' ', '-', $product);
            } else
              $product = $this->product;

            $this->productImage->saveAs('images/products/full/' . $product . '.' . $this->productImage->extension);

            return true;
        } else {
            return false;
        }
    }

    public function uploadThumb()
    {
        if ($this->validate()) {
            if ($this->isNewRecord) {
              $product = strtolower($this->name);
              $product = str_replace(' ', '-', $product);
            } else
              $product = $this->product;

            $this->productThumb->saveAs('images/products/thumbs/' . $product . '.' . $this->productThumb->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getProductTypes()
    {
      return [
        self::PRODUCT_BAKERY => 'Pastelería',
        // self::PRODUCT_PASTRY => 'Repostería',
        self::PRODUCT_DELI => 'Delicateses',
        // self::PRODUCT_MIX => 'Mixto',
      ];
    }

    public function getForms() {

        if ($this->type == self::PRODUCT_BAKERY) {

            $this->forms[0] =  self::PRODUCT_BAKERY;

            if ($this->priceSlice != null && $this->priceSlice != '')
                $this->forms[self::PRODUCT_SLICE] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_SLICE];

            if ($this->priceGlass != null && $this->priceGlass != '')
                $this->forms[self::PRODUCT_GLASS] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_GLASS];

            if ($this->priceFull != null && $this->priceFull != '')
                $this->forms[self::PRODUCT_FULL] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_FULL];

            if ($this->priceShot != null && $this->priceShot != '')
                $this->forms[self::PRODUCT_SHOT] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_SHOT];

            if ($this->price5oz != null && $this->price5oz != '')
                $this->forms[self::PRODUCT_5OZ] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_5OZ];

            if ($this->price8oz != null && $this->price8oz != '')
                $this->forms[self::PRODUCT_8OZ] = self::PRODUCT_FORMS_LABEL[self::PRODUCT_8OZ];

        } elseif ($this->type == self::PRODUCT_DELI) {

            if ($this->priceDeli != null && $this->priceDeli != '')
                $this->forms[0] =  self::PRODUCT_DELI;
        }

        return $this->forms;

    }

    public function getProductType($id)
    {
      return self::getProductTypes($id);
    }

}
