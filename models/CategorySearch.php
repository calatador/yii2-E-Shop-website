<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Category;

class CategorySearch extends Category
{
    public function search($params)
    {
        $this->setScenario(self::SCENARIO_SEARCH);
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->params['siteDefaults']['defaultPageSize'],
            ],
        ]);

        $this->load($params);
        if ($this->validate())
        {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }
        return $dataProvider;
    }
}