<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChargeRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Charge Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Charge Rates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'time_increment:datetime',
            'abriev',
            'integration_1',
            // 'integration_2',
            // 'integration_3',
            // 'integration_4',
            // 'integration_5',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
