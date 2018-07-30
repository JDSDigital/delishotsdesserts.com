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
					<h1>Empaques</h1>
				</div>
				<div class="col-md-6 text-right">
					<?= Html::a('Nuevo Empaque', ['packages/create'], ['class' => 'btn btn-success']) ?>
					<?= Html::a('Volver', ['default/index'], ['class' => 'btn btn-admin-2']) ?>
				</div>
			</div>

		</header>
		<div class="panel-body pl0 pr0">
			<?= GridView::widget([
                'dataProvider'   => $dataProvider,
                // 'filterModel' => $searchModel,
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
									'contentOptions' => ['style' => 'width: 90px;min-width: 90px'],
							],
              [
								'format' => 'raw',
                'attribute' => 'image',
                'value' => function ($model) {
                  return ($model->image) ? Html::img(Yii::getAlias('@web') . '/images/packages/' . $model->image, ['class' => 'img-responsive crop-thumb']) : $model->image;
                },
								'contentOptions' => ['style' => 'width: 200px;min-width: 100px'],
              ],
              [
                'attribute' => 'type_id',
                'value' => function ($model) {
                  return $model->type->name;
                }
              ],
              [
                'attribute' => 'name',
                'value' => function ($model) {
                  return $model->name;
                }
              ],
              [
                'attribute' => 'price',
                'value' => function ($model) {
                  return $model->price;
                }
              ],
              [
                'attribute' => 'quantity',
                'value' => function ($model) {
                  return $model->quantity;
                },
								'contentOptions' => ['style' => 'width: 100px;min-width: 100px'],
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
<?php $this->registerJs('listenerChangeStatus("'.Url::to(["packages/status"]).'");'); ?>
