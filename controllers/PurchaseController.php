<?php

namespace app\controllers;

use app\components\SberEqaer;
use app\models\Basket;
use app\models\Purchase;
use app\models\PurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Purchase models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Purchase();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Purchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPay()
    {
        $model = new Purchase();

        if ($this->request->isPost) {
            if(isset($this->request->post()['selection'])) {
                $dataProvider = new ActiveDataProvider([
                    'query' => Basket::find()->where(['id' => $this->request->post()['selection']]),
                ]);
        
                return $this->render('form', [
                    'product'=>$dataProvider,
                    'model' => $model,
                    'selection' => $this->request->post()['selection'],
                    'customer_choice' => Basket::getCustomerChoice($this->request->post()['selection']),
                    'summ'=> Basket::getSumm($this->request->post()['selection']),
                ]);
            }

        }

            return $this->redirect(['basket/index']);
    }


    public function actionFinish()
    {
        $model = new Purchase();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->bank_response=json_encode(SberEqaer::getPay($model->order_number, $model->amount));
                if($model->save()) {
                    $basket = new Basket();
                    $basket->deleteAll(['id' => json_decode($this->request->post()['selection'])]);
                    return $this->redirect(['basket/index']);
                }
                }
            } 
            return $this->redirect(['basket/index']);
    }


    /**
     * Deletes an existing Purchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
