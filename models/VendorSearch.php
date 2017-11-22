<?php

namespace app\models;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Vendor;

class VendorSearch extends Vendor
{
    public function search($params)
    {
        $this->setScenario(self::SCENARIO_SEARCH);
        $query = Vendor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->params['siteDefaults']['defaultPageSize'],
            ],
        ]);

        $this->load($params);
        if($this->validate())
        {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        return $dataProvider;
    }
}