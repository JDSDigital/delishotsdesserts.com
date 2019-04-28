<?php

use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

$this->title = 'Actualizar galería';
?>

<?= FileInput::widget([
    'name' => 'attachment_1[]',
    'language' => 'es',
    'options' => [
        'multiple' => true,
    ],
    'pluginOptions' => [
        'previewFileType' => 'image',
        'showCancel' => false,
        'showUpload' => false,
        'showDelete' => true,
        'allowedFileTypes' => ['image'],
        'allowedFileExtensions' => ['jpg', 'png'],
        'maxFileSize' => 2800,
        'maxFileCount' => 9,
        'overwriteInitial' => false,
        'initialPreview' => isset($previews) ? $previews : false,
        'initialPreviewAsData' => true,
        'initialPreviewShowDelete' => true,
        'initialPreviewConfig' => isset($previewsConfig) ? $previewsConfig : false,
        // 'otherActionButtons' => $btn,
    ]
]); ?>