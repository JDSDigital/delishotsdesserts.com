<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

$this->title = 'Actualizar galería';
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
    'name' => 'images',
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

<div class="form-group">
    <?= Html::submitButton('Guardar', [
        'class' => 'btn btn-success',
    ]) ?>
</div>

<?php ActiveForm::end(); ?>
