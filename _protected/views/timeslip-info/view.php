<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TimeslipInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timeslip Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeslip-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'labtech_timeslip_id:datetime',
            'labtech_ticket_id',
            'ticket_info_id',
            'billed_time_hours:datetime',
            'billed_time_mins:datetime',
            'charge_rate_id',
            'billing_account_id',
        ],
    ]) ?>

</div>
