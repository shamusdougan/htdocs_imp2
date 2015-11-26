<?php
namespace app\controllers;


use Yii;
use app\models\ChargeRatesAmounts;



class ChargeRatesAmountsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }





	public function actionAjaxCreate($charge_rate_id)
	{
		
		
		
		
		$chargeRateAmount = new ChargeRatesAmounts();

        if ($chargeRateAmount->load(Yii::$app->request->post()) && 	$chargeRateAmount->save()) 
        	{
        	$chargeRateAmount->valid_from_date = date("Y-m-d", strtotime($chargeRateAmount->valid_from_date));
        	$chargeRateAmount->save();
        		
			return true;
        	}
		else
			{
			$chargeRateAmount->charge_rate_id = $charge_rate_id;
			return $this->renderAjax('_form',['model' => $chargeRateAmount,]);
			}		

	}
	
	
	public function actionAjaxUpdate($id)
	{
		
		
		
		
		$chargeRateAmount = ChargeRatesAmounts::findOne($id);

        if ($chargeRateAmount->load(Yii::$app->request->post()) && 	$chargeRateAmount->save()) 
        	{
        	$chargeRateAmount->valid_from_date = date("Y-m-d", strtotime($chargeRateAmount->valid_from_date));
        	$chargeRateAmount->save();
        		
			return true;
        	}
		else
			{
			
			$chargeRateAmount->valid_from_date = date("d M Y", strtotime($chargeRateAmount->valid_from_date));
			
			return $this->renderAjax('_form',['model' => $chargeRateAmount,]);
			}		

	}

	
	public function actionAjaxDelete($id)
	{
		
		
		
		
		$chargeRateAmount = ChargeRatesAmounts::findOne($id);
		$chargeRateAmount->delete();
		
		return true;
	}
}
