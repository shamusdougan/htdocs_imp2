<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;



$this->registerJS(
	"$(document).on('click', '#refresh_contact', function()
		{
		$.pjax.reload({container:'#client-contact-grid-pjax'});	
		}  );
	"
);
	
if($model->id)
	{
	$this->registerJs(
	    "$(document).on('click', '#add_contact', function()  
	    {
	  	$.ajax
	  		({
	  		url: '".yii\helpers\Url::toRoute("client-contact/modal-create")."',
			data: {client_id: ".$model->id."},
			success: function (data, textStatus, jqXHR) 
				{
				$('.modal-body').removeData('bs.modal').find('.modal-content').empty();
				$('#activity-modal').modal();
				$('.modal-body').html(data);
	           
				},
	        error: function (jqXHR, textStatus, errorThrown) 
	        	{
	            console.log('An error occured!');
	            alert('Error in ajax request' );
	        	}
			});
	   	});"
	   );
  
	} 
 
 
 
 
  $this->registerJs(
    "$(document).on('click', '.activity-update-link', function() 
    	{
		$.ajax
  		({
  		url: '".yii\helpers\Url::toRoute("client-contact/modal-update")."',
		data: {id: $(this).closest('tr').data('key')},
		success: function (data, textStatus, jqXHR) 
			{
			$('.modal-body').removeData('bs.modal').find('.modal-content').empty();
			$('#activity-modal').modal();
			$('.modal-body').html(data);
          

			},
        error: function (jqXHR, textStatus, errorThrown) 
        	{
            console.log('An error occured!');
            alert('Error in ajax request' );
        	}
		});
		});
	"
   );
 
 
  $this->registerJs(
    "$(document).on('click', '.activity-delete-link', function() 
    	{
    	if(!confirm('Delete Contact?'))
    		{
				return;
			}
		$.ajax
  		({
  		url: '".yii\helpers\Url::toRoute("client-contact/modal-delete")."',
		data: {id: $(this).closest('tr').data('key')},
		success: function (data, textStatus, jqXHR) 
			{
			$.pjax.reload({container:'#client-contact-grid-pjax'});
			},
        error: function (jqXHR, textStatus, errorThrown) 
        	{
            console.log('An error occured!');
            alert('Error in ajax request' );
        	}
		});
		});
	"
   );
 
 

   
 
$this->registerJs("
$('body').on('beforeSubmit', 'form#modal_add_contact', function () {
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
				$.pjax.reload({container:'#client-contact-grid-pjax'});
				$('#activity-modal').modal('hide');
				
				
          }
     });
     return false;
});
"
);




		
$gridColumns = [
	['attribute' => 'firstname'],
	['attribute' => 'surname'],
	['attribute' => 'phone1'],
	['attribute' => 'mobile'],
	['attribute' => 'email'],
	[
	    'class'=>'kartik\grid\ActionColumn',
		'template' => '{update} {delete}',
		'contentOptions' => ['class' => 'padding-left-5px'],

	   	'buttons' => 
	   		[
			'update' => function ($url, $model, $key) 
	   			{
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>','#', 
                	[
                    'class' => 'activity-update-link',
                    'title' => 'Update',
					]);
				},
			'delete' => function ($url, $model, $key) 
	   			{
                return Html::a('<span class="glyphicon glyphicon-trash"></span>','#', 
                	[
                    'class' => 'activity-delete-link',
                    'title' => 'Delete',
					]);
				},
			],
	    'headerOptions'=>['class'=>'kartik-sheet-style'],
	],
	
	];	

		
		
//check if the model has been created and given an id, if allow contacts to be added
if(isset($model->id))
	{
	$toolbarButtons = Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Contact', 'class'=>'btn btn-success', 'id'=>'add_contact']) . ' '.
	Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Refresh Contacts', 'class'=>'btn btn-success', 'id'=>'refresh_contact']);
	}
else{
	$toolbarButtons = Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Contact', 'class'=>'btn btn-success', 'onclick' => 'alert("Save client Record before adding Contacts");']) . ' '.
	Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Refresh Contacts', 'class'=>'btn btn-success', 'id'=>'refresh_contact']);
	
	
}
	
	
	

echo GridView::widget(
		[
		'id' => 'client_contact-grid',
		'panel'=>[
        		'type'=>GridView::TYPE_PRIMARY,
        		'heading'=>"Company Contacts",
   		 ],
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> 
			[
				['content'=> $toolbarButtons],
			],
		'dataProvider'=> new yii\data\ActiveDataProvider(['query' => $model->getContacts()]),
		//'filterModel'=>$searchModel,
		'columns'=>$gridColumns,
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'pjax'=>true, 
		'pjaxSettings' =>
			[
			'neverTimeout'=>true,
			'options' =>['id' => 'client-contact-grid-pjax'],
			
			],
 		'export' => false,
		]);
	

	
		

?>