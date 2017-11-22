<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Product;

class Vendor extends ActiveRecord
{
    const SCENARIO_SEARCH = 'search';

    public static function tableName()
    {
        return 'vendor';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SEARCH] = ['title'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['title'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['title'], 'unique', 'on' => self::SCENARIO_DEFAULT],
            [['title'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() 
    {
        return [
            'title' => 'Vendor',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['vendor_id' => 'id']);
    }
}