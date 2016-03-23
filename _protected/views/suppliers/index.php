<?php

use yii\helpers\Html;
use app\components\actionButtons;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuppliersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-index">


	 <?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
         

            [
            'attribute' => 'name',
            'value' => function($data)
            	{
				return Html::a($data->name,['suppliers/update', 'id'=>$data->id]);
				},
			'format' => 'raw',
            ],
            'description',
            [
            'attribute' => 'active',
            'value' => function($data)
            	{
				return $data->active ? "Yes" : "No";
				},
            'filterType'=>GridView::FILTER_SELECT2,
    		'filter'=>[ 1 => 'Active', 0=> 'Inactive'], 
    		'filterWidgetOptions'=>[
        		'pluginOptions'=>['allowClear'=>true],
    			],
    		'filterInputOptions'=>['placeholder'=>'All'],
            'width' => '150px',
            ],
           
            'address',
            'city',

             [
            'class'=>'kartik\grid\ActionColumn',
			'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
