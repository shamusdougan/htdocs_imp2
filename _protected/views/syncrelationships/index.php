<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\syncrelationshipsSearch */
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

            'index',
            'impModelName',
            'endPointName',
            'endPointDataType',
            'frequenyMin',
            'lastSync',
            // 'LastStatus',
            // 'LastStatusData',

            ['class' => 'yii\grid\ActionColumn',
            	'template' => '{view} {update} {delete} {sync}',
            	'contentOptions' => ['style' => 'width:100px;'],
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
