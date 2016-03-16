<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use app\components\actionButtons;

$this->title = $model->syncModelName;
$this->params['breadcrumbs'][] = $this->title;

?>
  <h1><?= Html::encode($this->title) ?></h1>
  <?= actionButtons::widget(['items' => $actionItems]) ?>
    
    <p>
       
    </p>


<textarea cols=150 rows=20><? echo $result; ?></textarea>
 

</div>