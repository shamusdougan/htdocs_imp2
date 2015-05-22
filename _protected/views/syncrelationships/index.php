<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SyncrelationshipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Syncrelationships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncrelationships-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Syncrelationships', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'index',
            'impModelName',
            'endPointName',
            'endPointType',
            'endPointDBServer',
            // 'endPointDBName',
            // 'endPointDBTable',
            // 'endPointUser',
            // 'endPointPassword',
            // 'syncModelName',
            // 'frequenyMin',
            // 'lastSync',
            // 'LastStatus',
            // 'LastStatusData',
            // 'endPointFilePath',
            // 'endPointBaseURL:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
