<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use app\models\Vendor;
use app\models\Category;
use app\models\Product;

class ApiController extends Controller
{
    public function actionCategoryList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $search = Yii::$app->request->getQueryParam('search');
        $categories = Category::find();
        if ($search)
        {
            $categories->joinWith('products')
                    ->andWhere(['like', 'product.title', $search]);
        }
        $result = ['categories' => []];
        foreach ($categories->all() as $category)
        {
            $result['categories'][$category->id] = [
                'category' => $category->title
            ];
        }
        return $result;
    }

    public function actionProduct()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->getQueryParam('product');
        $product = Product::findOne($id);

        if ($product === null)
        {
            return [
                'error' => 1,
            ];
        }

        return [
            'title' => $product->title,
            'desc' => $product->desc,
            'image' => $product->image,
            'categories' => $product->categoriesString,
            'vendor' => $product->vendor->title,
            'error' => 0,
        ];
    }

    public function actionCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $category = Yii::$app->request->getQueryParam('category');
        $search = Yii::$app->request->getQueryParam('search');
        $page = Yii::$app->request->getQueryParam('page');
        $products = Product::find();
        if ($category)
        {
            $products->joinWith('categories')
                    ->andFilterWhere(['category_id' => $category])
                    ->groupBy('product.id');
        }
        if ($search)
        {
            $products->andFilterWhere(['like', 'product.title', $search]);
        }
        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->params['siteDefaults']['defaultPageSize'],
            'totalCount' => $products->count()
        ]);

        $products->offset($pagination->offset)
                ->limit($pagination->limit);

        $result = [
            'products' => [],
            'pages' => $pagination->pageCount,
            'total' => $pagination->totalCount
        ];

        foreach ($products->all() as $product)
        {
            $result['products'][$product->id] = [
                'title' => $product->title,
                'vendor' => $product->vendor->title,
                'image' => $product->image
            ];
        }

        return $result;
    }
}