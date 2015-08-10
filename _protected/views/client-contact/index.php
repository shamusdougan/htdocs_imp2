<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Client Contact', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firstname',
            'surname',
            'phone1',
            'phone2',
            // 'mobile',
            // 'email:email',
            // 'client_id',
            // 'address',
            // 'owner_contact',
            // 'accounts_contact',
            // 'authorized_contact',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
