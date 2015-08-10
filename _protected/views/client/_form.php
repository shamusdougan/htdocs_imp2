<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

  
<?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);     
   
    
$companyInfo = Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'name' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Company Name....'] ],
    		'ABN' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Company ABN'] ]
    	
    	]
    ]);
 
$companyInfo .= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>1,
    	'attributes'=>[
    		'address' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Company Address....'] ]
    	]
    ]);
    
$companyInfo .= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'city' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'City...'] ],
    		'state' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'State..'] ],
    		'postcode' => ['type' => FORM::INPUT_TEXT, 'options' => ['placeholder' => 'Postcode...'] ]
    		]
    
    ]);
    
$companyInfo .= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'phone1' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'Phone Number...'] ],
    		'phone2' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Phone Number...'] ]
    		]
    
    ]);
    
$companyInfo .= "<b>Billing Information</B>";
    
$companyInfo .= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'defaultBillingRate' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'Billing Rate Dropdown'] ],
    		'defaultBillingType' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Billing Type Dropdown'] ],
    		'accountBillTo' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Bill To Company'] ]
    		]
    
    ]);
    ?>

 

   

</div>





	



<?

echo TabsX::widget([
		'items'=> 
		[
			[			
			'label'=>'<i class="glyphicon glyphicon-home"></i> Company',
			'content'=>$companyInfo,
			
			],
			[
				'label'=>'<i class="glyphicon glyphicon-user"></i> Contacts',
				'content'=>$this->render("_contactGrid", ['model' => $model, 'form' => $form]),
				'active'=>true
			],
		],
		'position'=>TabsX::POS_ABOVE,
		'encodeLabels'=>false
]);
?>

 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>



<?php		
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">Contact Information</h4>',
    'size' => 'modal-lg',

]);		?>


<div id="modal_content"></div>

<?php

Modal::end(); 

?>



