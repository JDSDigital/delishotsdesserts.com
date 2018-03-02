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
			<h4>Postres</h4>
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
                     'description',
                     'priceFull',
                     'priceShot',
                     'price5oz',
                     'price8oz',
                    [
                        'class'          => 'yii\grid\ActionColumn',
                        'template'       => '{ul}{view}{update}',
                        'contentOptions' => ['style' => 'width: 80px;min-width: 50px'],
                    ],
                ],
            ]); ?>
		</div>
	</section>

	<section class="panel">
		<header class="panel-heading">
			<h4>Delicateses</h4>
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
					'priceDeli',
					[
						'class'          => 'yii\grid\ActionColumn',
						'template'       => '{ul}{view}{update}',
						'contentOptions' => ['style' => 'width: 80px;min-width: 50px'],
					],
				],
			]); ?>
		</div>
	</section>
</div>
<?php $this->registerJs('listenerChangeStatus("'.Url::to(["/admin/productstatus"]).'");'); ?>