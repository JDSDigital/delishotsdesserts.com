<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Option extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['product_id', 'form', 'quantity'], 'integer'],
            ['price', 'number'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Producto',
            'form'       => 'Presentación',
            'quantity'   => 'Cantidad',
            'price'      => 'Precio',
        ];
    }

    public function getProducts()
    {
        return Products::find()->where(['status' => Products::STATUS_ACTIVE])->all();
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function setCart($data)
    {
        $cart = [];
        $list = [];

        // Creates an array with the clients products
        foreach ($data['list'] as $item) {
            $product = Yii::$app->session->get('products')[$item[0]];
            $box = ($item[3] != 0) ? Yii::$app->session->get('boxes')[$item[3]] : 0;

            $boxTotal = ($box != 0) ? ceil($item[2] / $box['quantity']) * $box['price'] : 0;

            array_push($list, [
              'product' => $product['product'],
              'name' => $product['name'],
              'form' => ($item[1]) ? Products::PRODUCT_FORMS_LABEL[$item[1]] : null,
              'box' => ($box != 0) ? $box['image'] : 0,
              'boxPrice' => ($box != 0) ? $box['price'] : 0,
              'boxTotal' => $boxTotal,
              'price' => ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] : $product['priceDeli'],
              'priceTotal' => ($item[1]) ? $product[Products::PRODUCT_FORMS[$item[1]]] * $item[2] : $product['priceDeli'] * $item[2],
              'quantity' => $item[2],
            ]);
        }

        // Adds products and total to response array
        $cart['items'] = $list;
        $cart['total'] = $this->calculateTotal($data);

        // Sets the response array as a session variable
        Yii::$app->session->set('cart', $cart);

        return true;
    }

    public function calculateTotal($data)
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
}
