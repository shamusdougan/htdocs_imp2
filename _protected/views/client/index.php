<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'address',
            'city',
            // 'phone1',
            // 'phone2',
            // 'ABN',
            'defaultBillingRate',
            'defaultBillingType',
            'accountBillTo',
            // 'FK1',
            // 'FK2',
            // 'FK3',
            // 'FK4',
            // 'FK5',
            // 'last_change',
            // 'sync_status',
            'contact_billing',
            'contact_authorized',
            'contact_owner',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
