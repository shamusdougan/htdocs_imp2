<?php

namespace app\controllers;

use Yii;
use app\models\Purchases;
use app\models\PurchasesSearch;
use app\models\Suppliers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchasesController implements the CRUD actions for Purchases model.
 */
class PurchasesController extends Controller
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

	    $this->view->params['menuItem'] = 'purchases';

	    return true; // or false to not run the action
	}


    /**
     * Lists all Purchases models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchasesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$actionItems[] = ['label'=>'New', 'button' => 'new', 'url'=>"/purchases/create"];
		
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actionItems' => $actionItems,
        ]);
    }

    /**
     * Displays a single Purchases model.
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
     * Creates a new Purchases model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($ticket_info_id)
    {
        $model = new Purchases();
		$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'purchase-update-form', 'confirm' => 'Save Purchase and Exit?'];
    	$actionItems[] = ['label'=>'Cancel', 'button' => 'cancel', 'url'=>'/ticket-info/update?id='.$ticket_info_id, 'confirm' => 'Cancel Purchase?'];
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        	{
            return $this->redirect(['ticket-info/update', 'id' => $ticket_info_id]);
        	}
        else {
        	
        	
        	$supplierList = Suppliers::getSupplierListArray();
        	
            return $this->render('create', [
            	'ticket_info_id' => $ticket_info_id,
                'model' => $model,
                'actionItems' => $actionItems,
                'supplierList' => $supplierList,
            ]);
        }
    }

    /**
     * Updates an existing Purchases model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Purchases model.
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
     * Finds the Purchases model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchases the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchases::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
