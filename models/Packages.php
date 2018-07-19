<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ds_packages".
 *
 * @property int $id
 * @property int $type_id
 * @property string $name
 * @property double $price
 * @property string $image
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PackagesTypes $type
 */
class Packages extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $packageImage;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_packages';
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
          $package = strtolower($this->name);
          $package = str_replace(' ', '-', $package);
          $this->image = $package;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'name', 'price'], 'required'],
            [['type_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['name', 'image'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PackagesTypes::className(), 'targetAttribute' => ['type_id' => 'id']],

            [['packageImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Tipo',
            'name' => 'Nombre',
            'price' => 'Precio',
            'image' => 'Imágen',
            'packageImage' => 'Imágen',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PackagesTypes::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        $types = PackagesTypes::find()
          ->where(['status' => PackagesTypes::STATUS_ACTIVE])
          ->all();

        return ArrayHelper::map($types, 'id', 'name');
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->isNewRecord) {
              $package = strtolower($this->name);
              $package = str_replace(' ', '-', $package);
            } else
              $package = $this->package;

            $this->packageImage->saveAs('images/packages/' . $package . '.' . $this->packageImage->extension);

            return true;
        } else {
            return false;
        }
    }
}
