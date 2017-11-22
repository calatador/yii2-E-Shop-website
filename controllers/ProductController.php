<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Product;
use app\models\ProductSearch;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();
        $imageFile = null;

        if (Yii::$app->request->isPost)
        {
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model->imageFile = $imageFile;
            $model->upload();
            $model->save(); //Save uploaded file url in model
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->_findModel($id);
        $imageFile = null;

        if (Yii::$app->request->isPost)
        {
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
        }

        if ($model->load(Yii::$app->request->post()) &&
                $model->imageFile = &$imageFile &&
                $model->upload() && 
                $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        $model = $this->_findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function _findModel($id)
    {
        if (($model = Product::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('Product not found!');
        }
    }
}