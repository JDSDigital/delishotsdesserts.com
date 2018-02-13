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
}