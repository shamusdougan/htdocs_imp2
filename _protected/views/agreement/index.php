<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgreementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agreements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-index">


 	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'default_account_id',
            'default_BH_rate_id',
            'default_AH_rate_id',
            // 'default_project_rate_bh_id',
            // 'default_project_rate_ah_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
