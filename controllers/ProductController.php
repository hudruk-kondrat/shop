<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $fileName = time();
                $model->image = UploadedFile::getInstance($model, 'image');
                if (!empty($model->image)) {
                    $model->image->saveAs('uploads/obr_' . $fileName . '.' . $model->image->extension);
                    $model->path = 'uploads/obr_' . $fileName . '.' . $model->image->extension;
                }
                if($model->save()) {
                return $this->redirect(['product/index']);
                } else {
                return $this->redirect(['product/create']);
            }
        
        } else {
            $model->loadDefaultValues();
        }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $fileName = time();
                $model->image = UploadedFile::getInstance($model, 'image');
                if (!empty($model->image)) {
                    $model->image->saveAs('uploads/obr_' . $fileName . '.' . $model->image->extension);
                    $model->path = 'uploads/obr_' . $fileName . '.' . $model->image->extension;
                }
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->redirect(['update', 'id' => $model->id]);
            }
        
        } else {
            $model->loadDefaultValues();
        }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        if (file_exists($model->path)) {
            unlink($model->path);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionDelimage($id)
    {
        $model = $this->findModel($id);
        if (file_exists($model->path)) {
            unlink($model->path);
        }
        $model->path=Null;
        $model->save();
        return $this->redirect(['product/update', 'id' => $id]);
    }


    public function actionShowcase()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['=', 'active','1'])->orderBy(['price' => SORT_ASC])->asArray(),
        ]);

        return $this->render('showcase', [
            'models' => $dataProvider->models,
        ]);
    }

}
