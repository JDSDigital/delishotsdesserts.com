<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\imagine\Image;
use yii\web\UploadedFile;

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

    public $images = [];

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'ds_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['file'], 'required'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
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

    public static function getGalleryProducts(): array
    {
        return self::find()->where(['type' => self::GALLERY_PRODUCT])->all();
    }

    public static function getGalleryEvents(): array
    {
        return self::find()->where(['type' => self::GALLERY_EVENT])->all();
    }

    public function getFolder(): string
    {
        return ($this->type === self::GALLERY_EVENT)
            ? Yii::getAlias('@app') . '/web/images/gallery/events/'
            : Yii::getAlias('@app') . '/web/images/gallery/products/';
    }

    public function getImagefolder() : string
    {
        return ($this->type === self::GALLERY_EVENT)
            ? Yii::getAlias('@web') . '/images/gallery/events/'
            : Yii::getAlias('@web') . '/images/gallery/products/';
    }

    public function getThumb(): string
    {
        return $this->getImagefolder() . 'thumb-' . $this->file;
    }

    public function getImage(): string
    {
        return $this->getImagefolder() . 'full-' . $this->file;
    }

    public function upload(int $type): bool
    {
        $uploadedImages = UploadedFile::getInstances($this, 'images');

        if (count($uploadedImages) > 0) {

            foreach ($uploadedImages as $uploadedImage) {
                $image = new self;
                $image->type = $type;
                $name = strtolower($uploadedImage->name);

                $image->file = $name;

                if ($image->save()) {
                    $image->saveImage($uploadedImage, $name);
                }
                
            }

            return true;
        }

        return false;
    }

    public function saveImage(UploadedFile $uploadedImage, string $name): bool
    {
        $uploadedImage->saveAs(self::getFolder() . 'tmp-' . $name);

        Image::resize(self::getFolder() . 'tmp-' . $name, 1024, null)
        ->save(self::getFolder() . 'full-' . $name, ['jpeg_quality' => 80]);

        Image::resize(self::getFolder() . 'tmp-' . $name, 300, null)
        ->save(self::getFolder() . 'thumb-' . $name, ['jpeg_quality' => 80]);

        unlink(self::getFolder() . 'tmp-' . $name);

        return true;
    }

}
