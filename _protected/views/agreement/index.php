<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\components\actionButtons;
use kartik\builder\Form;

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

            'name',
            [
            'attribute' => 'defaultAccount.name',
            'label' => 'Default Account',
           
            ],
            [
            'attribute' => 'defaultBHRate.name',
            'label' => 'Default BH Rate',
             'value' => function($data) 
            	{
				return $data->defaultBHRate->abriev." ($".$data->defaultBHRate->getCurrentRate().")";
				}
            ],
           	[
            'attribute' => 'defaultAHRate.name',
            'label' => 'Default AH Rate',
             'value' => function($data) 
            	{
				return $data->defaultAHRate->abriev." ($".$data->defaultAHRate->getCurrentRate().")";
				}
            ],
     		[
            'attribute' => 'defaultProjAccount.name',
            'label' => 'Default Project Account',
           
            ],
           	[
            'attribute' => 'defaultProjBHRate.name',
            'label' => 'Default Project BH Rate',
             'value' => function($data) 
            	{
				return $data->defaultProjBHRate->abriev." ($".$data->defaultProjBHRate->getCurrentRate().")";
				}
            ],
            [
            'attribute' => 'defaultProjAHRate.name',
            'label' => 'Default Project AH Rate',
             'value' => function($data) 
            	{
				return $data->defaultProjAHRate->abriev." ($".$data->defaultProjAHRate->getCurrentRate().")";
				}
            ],
          

            [
	            'class'=>'kartik\grid\ActionColumn',
				'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
