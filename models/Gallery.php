<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_gallery".
 *
 * @property int $id
 * @property int $type
 * @property string $file
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    const GALLERY_PRODUCT = 1;
    const GALLERY_EVENT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['file'], 'required'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Tipo',
            'file' => 'Archivo',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
        ];
    }

    public static function getGalleryProducts()
    {
        return self::find()->where(['type' => self::GALLERY_PRODUCT])->all();
    }

    public static function getGalleryEvents()
    {
        return self::find()->where(['type' => self::GALLERY_EVENT])->all();
    }

    public function getThumb()
    {
        return ($this->type === self::GALLERY_EVENT)
            ? Yii::getAlias('@web') . '/images/gallery/events/thumb-' . $this->file
            : Yii::getAlias('@web') . '/images/gallery/products/thumb-' . $this->file;
    }

    public function getImage()
    {
        return ($this->type === self::GALLERY_EVENT)
            ? Yii::getAlias('@web') . '/images/gallery/events/full-' . $this->file
            : Yii::getAlias('@web') . '/images/gallery/products/full-' . $this->file;
    }

}
