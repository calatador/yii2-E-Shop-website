<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;

class ProductSearch extends Product
{
    public function search($params)
    {
        $this->setScenario(self::SCENARIO_SEARCH);
        $query = Product::find()->joinWith('categories')->groupBy('product.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->params['siteDefaults']['defaultPageSize'],
            ],
            'sort' => ['attributes' => ['title']],
        ]);

        $this->load($params);
        if ($this->validate())
        {
            $query->andFilterWhere(['like', 'product.title', $this->title])
                ->andFilterWhere(['vendor_id' => $this->vendor_id])
                ->andFilterWhere(['category_id' => array_filter($this->categories)]);
        }
        return $dataProvider;
    }
}