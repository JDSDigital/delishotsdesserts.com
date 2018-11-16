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
    const PRODUCT_BOMBON = 5;

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
            'productImage' => 'Imagen Completa',
            'productThumb' => 'Imagen en Miniatura',
            'product' => 'Producto',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'type' => 'Tipo',
            'priceSlice' => 'Porción Individual',
            'priceGlass' => 'Envase',
            'priceFull' => 'Precio Completo',
            'priceShot' => 'Precio Shot',
            'price5oz' => 'Precio 5oz',
            'price8oz' => 'Precio 8oz',
            'priceDeli' => 'Precio Individual',
            'status' => 'Estado',
        ];
    }

    /**
     *  Sets a session variable with an array of active products
     *  @return array
     */
    public function getProductsArray()
    {
        $this->unsetSessionVariables();

        $this->setSessionVariableProducts();
        $this->setSessionVariableBoxes();
        $this->setSessionVariableForms();
        $this->setSessionVariableQuantities();
        $this->setSessionVariableTypeQuantities();
        $this->setSessionVariableShowPrices();

        return true;
    }

    public function unsetSessionVariables()
    {
        if (Yii::$app->session->has('cart')) {
            Yii::$app->session->remove('cart');
        }

        if (Yii::$app->session->has('products')) {
            Yii::$app->session->remove('products');
        }

        if (Yii::$app->session->has('boxes')) {
            Yii::$app->session->remove('boxes');
        }

        if (Yii::$app->session->has('quantities')) {
            Yii::$app->session->remove('quantities');
        }

        if (Yii::$app->session->has('typequantities')) {
            Yii::$app->session->remove('typequantities');
        }

        if (Yii::$app->session->has('showprices')) {
            Yii::$app->session->remove('showprices');
        }

        return true;
    }

    public function setSessionVariableProducts()
    {
        $products = Products::find()
          ->where(['status' => Products::STATUS_ACTIVE])
          ->asArray()
          ->all();

        array_unshift($products, [0]);

        Yii::$app->session->set('products', $products);

        return true;
    }

    public function setSessionVariableBoxes()
    {
        $boxes = Packages::find()
          ->select(['id', 'type_id', 'name', 'price', 'quantity', 'status', 'image'])
          ->where(['status' => Packages::STATUS_ACTIVE])
          ->asArray()
          ->all();

        array_unshift($boxes, [0]);

        Yii::$app->session->set('boxes', $boxes);

        return true;
    }

    public function setSessionVariableForms()
    {
        $forms = [0 => 0];
        $products = Yii::$app->session->get('products');

        foreach ($products as $key => $product) {

            if ($key == 0) {
                continue;
            }

            switch ($product['type']) {
                case Products::PRODUCT_BAKERY:
                    array_push($forms, $this->setProductFormsTypeBakery($product));
                    break;

                case Products::PRODUCT_DELI:
                    array_push($forms, [0 => self::PRODUCT_DELI]);
                    break;

                case Products::PRODUCT_BOMBON:
                    array_push($forms, [0 => self::PRODUCT_BOMBON]);
                    break;

                default:
                    array_push($forms, [0 => null]);
                    break;
            }
        }

        Yii::$app->session->set('forms', $forms);

        return true;
    }

    public function setSessionVariableQuantities()
    {
        Yii::$app->session->set('quantities', self::PRODUCT_QUANTITIES);

        return true;
    }

    public function setSessionVariableTypeQuantities()
    {
        Yii::$app->session->set('typequantities', self::PRODUCT_TYPE_QUANTITIES);

        return true;
    }

    public function setProductFormsTypeBakery($product)
    {
        $response = [];
        $response[0] = Products::PRODUCT_BAKERY;

        foreach (self::PRODUCT_FORMS as $key => $value) {
            if ($product[$value] != null && $product[$value] != '') {
                $response[$key] = self::PRODUCT_FORMS_LABEL[$key];
            }
        }

        return $response;
    }

    public function setSessionVariableShowPrices()
    {
        $prices = System::findOne(1);
        Yii::$app->session->set('showprices', $prices->show_prices);

        return true;
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->isNewRecord) {
                $product = strtolower($this->name);
                $product = str_replace(' ', '-', $product);
            } else {
                $product = $this->product;
            }

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
            } else {
                $product = $this->product;
            }

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
        self::PRODUCT_BOMBON => 'Bombonería',
      ];
    }

    public function getForms() {

        if ($this->type == self::PRODUCT_BAKERY) {

            $this->forms[0] =  self::PRODUCT_BAKERY;

            foreach (self::PRODUCT_FORMS as $key => $value) {
                if ($this->$value != null && $this->$value != '') {
                    $this->forms[$key] = self::PRODUCT_FORMS_LABEL[$key];
                }
            }

        } elseif ($this->type == self::PRODUCT_DELI) {

            if ($this->priceDeli != null && $this->priceDeli != '') {
                $this->forms[0] =  self::PRODUCT_DELI;
            }
        }

        return $this->forms;

    }

    public function getProductType($id)
    {
        return self::getProductTypes($id);
    }

    public function deleteProductWithImages()
    {
        if (!unlink('images/products/full/' . $this->product . '.jpg')) {
            Yii::$app->session->setFlash('error', 'Error al eliminar las fotos del producto');
            return null;
        }

        if (!unlink('images/products/thumbs/' . $this->product . '.jpg')) {
            Yii::$app->session->setFlash('error', 'Error al eliminar las fotos del producto');
            return null;
        }

        if ($this->delete()) {

            Yii::$app->session->setFlash('success', 'Producto eliminado exitosamente.');

        } else {

            foreach ($this->errors as $error) {
                Yii::$app->session->setFlash('error', $error);
            }
            
            return null;
        }
    }

}
