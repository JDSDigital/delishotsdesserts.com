<?php
/**
 * @var $this  yii\web\View
 * @var $model @var $model common\modules\xProducts\Models\Products
 * @var $form  yii\bootstrap\ActiveForm
 */

use app\models\Products;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="xClients-default-index">
	<div class="container">
		<div class="row panel panel-flat">
			<div class="col-md-5 ml20">

				<?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

				<?php if ($model->type == Products::PRODUCT_BAKERY) : ?>

					<?= $form->field($model, 'priceSlice')->textInput() ?>

					<?= $form->field($model, 'priceGlass')->textInput() ?>

					<?= $form->field($model, 'priceFull')->textInput() ?>

					<?= $form->field($model, 'priceShot')->textInput() ?>

					<?= $form->field($model, 'price5oz')->textInput() ?>

					<?= $form->field($model, 'price8oz')->textInput() ?>

				<?php elseif ($model->type == Products::PRODUCT_DELI) : ?>

					<?= $form->field($model, 'priceDeli')->textInput() ?>

				<?php endif; ?>

                <div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                    ]) ?>
                    <?= Html::a(Yii::t('app', 'volver'), ['index'], [
                        'class' => 'btn btn-danger',
                    ]) ?>
				</div>

                <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
