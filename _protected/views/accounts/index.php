<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $searchModel app\models\accountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">


	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            'name',
            [
            'attribute' => 'billable',
            'value' => function($data)
            	{
				return ($data->billable ? "Yes" : "No");	
				}
            
            ],
           
            [
	            'class'=>'kartik\grid\ActionColumn',
				'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
