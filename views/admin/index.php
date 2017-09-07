<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
?>
<div class="container">
	<section class="panel">
		<header class="panel-heading">
			<h4><?= $this->title ?></h4>
		</header>
		<div class="panel-body pl0 pr0">
			<?= GridView::widget([
                'dataProvider'   => $dataProvider,
                //'filterModel'    => $searchModel,
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
                    ['class' => 'yii\grid\SerialColumn'],
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
</div>
