<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2mod\cart\models\CartItemInterface;

class Products extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const PRODUCT_FULL = 1;
    const PRODUCT_SHOT = 2;
    const PRODUCT_5OZ = 3;
    const PRODUCT_8OZ = 4;

    const PRODUCT_FORMS = [
        self::PRODUCT_FULL => 'priceFull',
        self::PRODUCT_SHOT => 'priceShot',
        self::PRODUCT_5OZ => 'price5oz',
        self::PRODUCT_8OZ => 'price8oz',
    ];

    const PRODUCT_QUANTITIES = [
        self::PRODUCT_FULL => [1,2,3,4],
        self::PRODUCT_SHOT => [20,30,40,50,60,70,80,90,100],
        self::PRODUCT_5OZ => [6,12,18,24,30,36,42,48,54,60],
        self::PRODUCT_8OZ => [6,12,18,24,30,36,42,48,54,60],
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
            [['status', 'priceFull', 'priceShot', 'price5oz', 'price8oz'], 'integer'],
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
            'status' => 'Estado',
        ];
    }

    /*public function getProducts()
    {
        $products = [
            [
                'product'     => 'caramel-dreams',
                'name'        => 'Caramel Dreams',
                'description' => 'Es un postre exquisito conformado por deliciosos y vaporosos suspiros que navegan elegantemente sobre una crema inglesa ligeramente espesa y sutil.',
            ],
            [
                'product'     => 'four-elements',
                'name'        => 'Four Elements',
                'description' => 'Es una deliciosa torta húmeda que consiste en un bizcocho bañado con tres tipos de leche: leche evaporada, leche condensada y crema de leche. Acompañado de merengue aromatizado con esencia de caramelo.',
            ],
            [
                'product'     => 'sweet-lemon',
                'name'        => 'Sweet Passion',
                'description' => 'Este pastel es una combinación deliciosa, de base crujiente de galletas, con un relleno muy cremoso con sabor y aroma a limones frescos o parchita, no hay mejor manera de coronar este postre que con nuestra especial nube de merengue.',
            ],
            [
                'product'     => 'choco-lovers',
                'name'        => 'Choco Lovers',
                'description' => 'El Choco Lovers es un delicioso mousse, que consta de una textura espumosa elaborado con el mejor chocolate combinándolo con pequeños trozos de galleta y trufa que complementan su exquisito sabor.',
            ],
            [
                'product'     => 'soft-hazelnuts',
                'name'        => 'Soft Hazelnuts',
                'description' => 'Exquisita torta en capas, donde se alterna un bizcocho de almendras con una suave crema de mantequilla y avellanas.',
            ],
            [
                'product'     => 'three-elements',
                'name'        => 'Three Elements',
                'description' => 'Es un dulce conformado por múltiples capas de bizcocho, crema de mantequilla y leche condensada, complementada con un topping de almendras caramelizadas y ganache de chocolate, logrando una combinación mundial.',
            ],
            [
                'product'     => 'crazy-brownie',
                'name'        => 'Crazy Brownie',
                'description' => 'El brownie original es un bizcocho de chocolate con nueces de origen estadounidense. Nuestro brownie lo preparamos con un tope delicado de leche condensada y nutella.',
            ],
            [
                'product'     => 'dark-explotion',
                'name'        => 'Dark Explotion',
                'description' => 'Es una torta atractiva y enigmática, con discos de merengue de chocolate apilados entre capas de delicioso mousse de chocolate y decorada con merengues crujientes.',
            ],
        ];

        return $products;
    }*/
}