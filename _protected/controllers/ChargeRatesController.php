<?php

namespace app\controllers;

use Yii;
use app\models\ChargeRates;
use app\models\ChargeRatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChargeRatesController implements the CRUD actions for ChargeRates model.
 */
class ChargeRatesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }



	public function beforeAction($action)
	{
	    if (!parent::beforeAction($action)) {
	        return false;
	    }

	    $this->view->params['menuItem'] = 'charge-rates';

	    return true; // or false to not run the action
	}


    /**
     * Lists all ChargeRates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChargeRatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 		$actionItems[] = ['label'=>'New', 'button' => 'new', 'url'=>"/charge-rates/create"];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actionItems' => $actionItems,
        ]);
    }

    /**
     * Displays a single ChargeRates model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChargeRates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChargeRates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            
            
            
            $get = Yii::$app->request->get();
    		if(isset($get['exit']) && $get['exit'] == 'false' )
    			{
				return $this->redirect(['update', 'id' => $model->id]);
				}
			else{
				return $this->redirect(['index']);
				}
        
        
        
        
        	} 
        
        
        
        else 
        	{
            
            
           	$actionItems[] = ['label'=>'Back', 'button' => 'back', 'url'=>'index'];
			$actionItems[] = ['label'=>'Save', 'button' => 'save', 'overrideAction' =>'/charge-rates/create?exit=false', 'url'=>null, 'submit'=> 'charge-rate-form', 'confirm' => 'Save Charge Rate Information and Exit?'];
        	$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'charge-rate-form', 'confirm' => 'Save Charge Rate Information and Exit?'];
        	
      		$model->status = ChargeRates::STATUS_ACTIVE;
      		$model->time_increment = 15;
      
            return $this->render('create', [
                'model' => $model,
                'actionItems' => $actionItems,
            ]);
        }
    }

    /**
     * Updates an existing ChargeRates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        	{
            return $this->redirect(['index']);
        	}
        else {
        	
        	
        	
	     	$actionItems[] = ['label'=>'Back', 'button' => 'back', 'url'=>'index'];
			$actionItems[] = ['label'=>'Save', 'button' => 'save', 'overrideAction' =>'/charge-rates/create?exit=false', 'url'=>null, 'submit'=> 'charge-rate-form', 'confirm' => 'Save Charge Rate Information?'];
	    	$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'charge-rate-form', 'confirm' => 'Save Charge Rate Information and Exit?'];
	    	
	        return $this->render('update', [
	                'model' => $model,
	                'actionItems' => $actionItems,
	            ]);
        	}
    }

    /**
     * Deletes an existing ChargeRates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChargeRates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChargeRates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChargeRates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
