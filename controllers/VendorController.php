<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Vendor;
use app\models\VendorSearch;

class VendorController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Vendor();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['/vendor/view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['/vendor/view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model
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

    public function actionDelete($id)
    {
        $model = $this->_findModel($id);

        $model->delete();
        $this->redirect('/vendor');
    }

    protected function _findModel($id)
    {
        if (($model = Vendor::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('Vendor not found!');
        }
    }
}