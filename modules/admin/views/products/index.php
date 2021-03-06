<?php

use app\models\Products;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProviderBakery yii\data\ActiveDataProvider */
/* @var $dataProviderDeli yii\data\ActiveDataProvider */

$this->title = 'Productos';
?>
<div class="container admin-panel">
	<section class="panel">
		<header class="panel-heading">
			<div class="row">
				<div class="col-md-6">
					<h1>Postres</h1>
				</div>
				<div class="col-md-6 text-right">
					<?= Html::a('Nuevo Producto', ['products/create'], ['class' => 'btn btn-success']) ?>
					<?= Html::a('Volver', ['default/index'], ['class' => 'btn btn-admin-2']) ?>
				</div>
			</div>

		</header>
		<div class="panel-body pl0 pr0">
			<?= GridView::widget([
                'dataProvider'   => $dataProviderBakery,
                'options'        => [
                    'class' => 'table-responsive',
                ],
                'tableOptions'   => [
                    'class' => 'table table-striped table-hover',
                ],
                'pager'          => [
                    'options' => [
                        'class' => 'pagination ml20 mt10',
                    ],
                ],
                'summaryOptions' => [
                    'class' => 'summary ml20 mt25',
                ],
                'layout'         => '{items}{pager}{summary}',
                'columns'        => [
					[
						'attribute' => 'status',
						'format' => 'raw',
						'value'     => function ($model) {
							$check = ($model->status == Products::STATUS_ACTIVE) ? "checked='checked'" : null;

							return "<div class='switchery-xs m0'>
                      <input id='status-$model->id' type='checkbox' class='switchery switchStatus' $check>
                  </div>";
								},
							],
               'name',
               [
								 'attribute' => 'description',
								 'value' => function ($model) {
									 return $model->description;
								 }
							 ],
							 [
								 'attribute' => 'priceSlice',
								 'value' => function ($model) {
									 return ($model->priceSlice) ? Yii::$app->formatter->asCurrency($model->priceSlice) : 'Inexistente';
								 }
							 ],
               [
								 'attribute' => 'priceGlass',
								 'value' => function ($model) {
									 return ($model->priceGlass) ? Yii::$app->formatter->asCurrency($model->priceGlass) : 'Inexistente';
								 }
							 ],
               [
								 'attribute' => 'priceFull',
								 'value' => function ($model) {
									 return ($model->priceFull) ? Yii::$app->formatter->asCurrency($model->priceFull) : 'Inexistente';
								 }
							 ],
               [
								 'attribute' => 'priceShot',
								 'value' => function ($model) {
									 return ($model->priceShot) ? Yii::$app->formatter->asCurrency($model->priceShot) : 'Inexistente';
								 }
							 ],
               [
								 'attribute' => 'price5oz',
								 'value' => function ($model) {
									 return ($model->price5oz) ? Yii::$app->formatter->asCurrency($model->price5oz) : 'Inexistente';
								 }
							 ],
               [
								 'attribute' => 'price8oz',
								 'value' => function ($model) {
									 return ($model->price8oz) ? Yii::$app->formatter->asCurrency($model->price8oz) : 'Inexistente';
								 }
							 ],
              [
                  'class'          => 'yii\grid\ActionColumn',
                  'template'       => '{ul}{view}{update}{delete}',
                  'contentOptions' => ['style' => 'width: 100px;min-width: 100px'],
              ],
          ],
      ]); ?>
		</div>
	</section>

	<section class="panel">
		<header class="panel-heading">
			<h1>Delicateses</h1>
		</header>
		<div class="panel-body pl0 pr0">
			<?= GridView::widget([
				'dataProvider'   => $dataProviderDeli,
				'options'        => [
					'class' => 'table-responsive',
				],
				'tableOptions'   => [
					'class' => 'table table-striped table-hover',
				],
				'pager'          => [
					'options' => [
						'class' => 'pagination ml20 mt10',
					],
				],
				'summaryOptions' => [
					'class' => 'summary ml20 mt25',
				],
				'layout'         => '{items}{pager}{summary}',
				'columns'        => [
					[
						'attribute' => 'status',
						'format' => 'raw',
						'value'     => function ($model) {
							$check = ($model->status == Products::STATUS_ACTIVE) ? "checked='checked'" : null;

							return "<div class='switchery-xs m0'>
                                    <input id='status-$model->id' type='checkbox' class='switchery switchStatus' $check>
                                </div>";
						},
					],
					'name',
					'description',
					[
						'attribute' => 'priceDeli',
						'value' => function ($model) {
							return ($model->priceDeli) ? Yii::$app->formatter->asCurrency($model->priceDeli) : 'Inexistente';
						}
					],
					[
						'class'          => 'yii\grid\ActionColumn',
						'template'       => '{ul}{view}{update}{delete}',
						'contentOptions' => ['style' => 'width: 100px;min-width: 100px'],
					],
				],
			]); ?>
		</div>
	</section>

	<section class="panel">
		<header class="panel-heading">
			<h1>Bombonería</h1>
		</header>
		<div class="panel-body pl0 pr0">
			<?= GridView::widget([
				'dataProvider'   => $dataProviderBombon,
				'options'        => [
					'class' => 'table-responsive',
				],
				'tableOptions'   => [
					'class' => 'table table-striped table-hover',
				],
				'pager'          => [
					'options' => [
						'class' => 'pagination ml20 mt10',
					],
				],
				'summaryOptions' => [
					'class' => 'summary ml20 mt25',
				],
				'layout'         => '{items}{pager}{summary}',
				'columns'        => [
					[
						'attribute' => 'status',
						'format' => 'raw',
						'value'     => function ($model) {
							$check = ($model->status == Products::STATUS_ACTIVE) ? "checked='checked'" : null;

							return "<div class='switchery-xs m0'>
                                    <input id='status-$model->id' type='checkbox' class='switchery switchStatus' $check>
                                </div>";
						},
					],
					'name',
					'description',
					[
						'attribute' => 'priceDeli',
						'value' => function ($model) {
							return ($model->priceDeli) ? Yii::$app->formatter->asCurrency($model->priceDeli) : 'Inexistente';
						}
					],
					[
						'class'          => 'yii\grid\ActionColumn',
						'template'       => '{ul}{view}{update}{delete}',
						'contentOptions' => ['style' => 'width: 100px;min-width: 100px'],
					],
				],
			]); ?>
		</div>
	</section>
</div>
<?php $this->registerJs('listenerChangeStatus("'.Url::to(["/admin/productstatus"]).'");'); ?>
