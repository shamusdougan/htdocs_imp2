<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\clientSearch */
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

            'id',
            'name',
            'ownerContact',
            'authorizedContact',
            'billingContact',
            // 'address',
            // 'city',
            // 'state',
            // 'postcode',
            // 'phone1',
            // 'phone2',
            // 'ABN',
            // 'IntegrationID1',
            // 'IntegrationID2',
            // 'IntegrationID3',
            // 'defaultBillingRate',
            // 'deafultBillingType',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
