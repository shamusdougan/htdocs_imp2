<?php

use yii\helpers\Html;
use app\components\actionButtons;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchases-index">


	 <?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
           

            
           
            'description',
            'qty',
            'purchase_exGST',
            'sell_exGST',
            'supplier_id',
           	'purchase_order_id',
            'ticket_info_id',

            [
            'class'=>'kartik\grid\ActionColumn',
			'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
