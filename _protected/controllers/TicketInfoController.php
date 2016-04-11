<?php

namespace app\controllers;

use Yii;
use app\models\TicketInfo;
use app\models\TicketInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketInfoController implements the CRUD actions for TicketInfo model.
 */
class TicketInfoController extends Controller
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

	    $this->view->params['menuItem'] = 'tickets';

	    return true; // or false to not run the action
	}

    /**
     * Lists all TicketInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TicketInfo model.
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
     * Creates a new TicketInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TicketInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TicketInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'ticket-info-update-form', 'confirm' => 'Save Ticket Information and Exit?'];
    	$actionItems[] = ['label'=>'Cancel', 'button' => 'cancel', 'url'=>'/labtech-tickets/index', 'confirm' => 'Cancel Changes?'];
    	$actionItems[] = ['label'=>'Add Hardware', 'button' => 'new', 'url'=>'/purchases/create?ticket_info_id='.$model->id];
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        	{
            return $this->redirect(['labtech-tickets/index']);
        	}
        else {
        
            return $this->render('update', [
                'model' => $model,
                'actionItems' => $actionItems,
                
            ]);
        }
    }
    
    
    /**
	* 
	* Function UpdateTimeslips
	* Description: this function will go through and update the chargerate and billing account on the timeslip 
	* 
	* @return
	*/
    public function actionUpdateTimeslips($id)
    {
		$model = $this->findModel($id);
		foreach($model->timeslipsInfos as $timeslipInfo)
			{
			$timeslipInfo->charge_rate_id = $model->default_charge_rate_id;
			$timeslipInfo->billing_account_id = $model-> default_billing_account_id;
			$timeslipInfo->save();
			}
		
		
		
	}

    /**
     * Deletes an existing TicketInfo model.
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
     * Finds the TicketInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TicketInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TicketInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
