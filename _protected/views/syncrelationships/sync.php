<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use app\components\actionButtons;


$this->params['breadcrumbs'][] = $this->title;

?>
 
  <?= actionButtons::widget(['items' => $actionItems]) ?>
 
    <p>
       
    </p>


<textarea cols=150 rows=20><? echo $result; ?></textarea>
 

</div>