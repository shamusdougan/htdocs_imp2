<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticket Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'labtech_ticket_id',
            'client_id',
            'imp_status',
            'invoice_date',
            // 'invoice_id',
            // 'default_billing_account_id',
            // 'default_charge_rate_id',
            // 'labtech_computer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
