<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\lookup;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SyncrelationshipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Syncrelationships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncrelationships-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Syncrelationships', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'impModelName:text:Source',
            'endPointName:text:Target',
 //           'endPointType',
          
	        'frequenyMin',
	        'lastSync',
            'LastStatus',
	          array(
	        	'attribute' => 'endPointType',
	           	'value' => function($data) {
	        					return Lookup::item($data->endPointType, "SyncEndPointType");
								},
	            'filter' => Lookup::items("SyncEndPointType"),
	        
	           ),
	        'endPointUser',
	        'endPointPassword',
            'endPointDBServer',
            'endPointDBName',
            'endPointDBTable',
            'endPointFilePath',
            'endPointBaseURL:url',
            'syncModelName',
            
            
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
