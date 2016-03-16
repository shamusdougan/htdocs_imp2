<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabtechTimeslipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labtech Timeslips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labtech-timeslips-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Labtech Timeslips', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TimeSlipID:datetime',
            'UserID',
            'ClientID',
            'ProjectID',
            'TicketID',
            // 'Hours',
            // 'Mins',
            // 'Done',
            // 'Date',
            // 'Description',
            // 'Billed',
            // 'Category',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
