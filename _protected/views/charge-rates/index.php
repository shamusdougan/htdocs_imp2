<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChargeRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Charge Rates';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?= actionButtons::widget(['items' => $actionItems]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'time_increment',
            'abriev',
            [
            'attribute' => 'currentRate',
            'hAlign' => 'right'
            ],
            
            //'integration_1',
            // 'integration_2',
            // 'integration_3',
            // 'integration_4',
            // 'integration_5',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
