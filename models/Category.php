<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Product;

class Category extends ActiveRecord
{
    const SCENARIO_SEARCH = 'search';

    public static function tableName()
    {
        return 'category';
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
            'title' => 'Category Title',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
                ->viaTable('category_product', ['category_id' => 'id']);
    }

    public function delete()
    {
        foreach ($this->products as $product)
        {
            $this->unlink('products', $product, true);
        }
        parent::delete();
    }
}