<?php

namespace app\models;

use yii\db\ActiveRecord;

class CategoryProduct extends ActiveRecord
{
    public static function tableName()
    {
        return 'category_product';
    }
}