<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Category;
use app\models\CategorySearch;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $this->redirect(['/category/view', 'id' => $model->id]);
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
            $this->redirect(['/category/view', 'id' => $model->id]);
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

    public function actionDelete($id)
    {
        $model = $this->_findModel($id);

        $model->delete();

        return $this->redirect('/category');
    }

    protected function _findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) 
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('Category not found!');
        }
    }
}