<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_system".
 *
 * @property int $id
 * @property int $show_prices
 */
class System extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show_prices'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_prices' => 'Mostrar Precios',
        ];
    }
}
