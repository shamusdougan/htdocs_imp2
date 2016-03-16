<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TimeslipInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timeslip Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeslip-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Timeslip Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'labtech_timeslip_id:datetime',
            'labtech_ticket_id',
            'ticket_info_id',
            'billed_time_hours:datetime',
            // 'billed_time_mins:datetime',
            // 'charge_rate_id',
            // 'billing_account_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
