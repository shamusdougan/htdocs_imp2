<?php

use yii\helpers\Html;
use app\components\actionButtons;
use kartik\grid\GridView;
use app\models\lookup;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SyncrelationshipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Syncrelationships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncrelationships-index">

	 <?= actionButtons::widget(['items' => $actionItems]) ?>
  
    <h1><?= Html::encode($this->title) ?></h1>
    
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

 //           'impModelName:text:Source',
 //           'endPointName:text:Target',
 //           'endPointType',
 			'description',
          	'syncModelName',
          	'endPoint',
          	'username',
          	'password',
	        'frequenyMin',
	        'lastSync',
	        	[
	        	'attribute' => 'LastStatus',
	        	'value' => function ($data) {
							return Lookup::item($data->LastStatus, "SYNC_RESULT");
							},
				
	        	],
	       
	       // 'endPointUser',
	        //'endPointPassword',
            //'endPointDBServer',
            //'endPointDBName',
            //'endPointDBTable',
            //'endPointFilePath',
            //'endPointBaseURL:url',
            //'syncModelName',
            
            
           

             ['class' => 'kartik\grid\ActionColumn',
            	'template' => '{update} {delete} {sync}',
            	'noWrap' => true,
            	'buttons' => 
            		[
            		'sync' => function ($url, $model){
						return Html::a('<span class="glyphicon glyphicon-refresh"></span>', $url, [
							'title' => Yii::t('app', "Sync"),
						]);
						}
            		]
            ],
        ],
    ]); ?>

</div>
