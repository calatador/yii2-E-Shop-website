<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Vendor;
use yii\web\UploadedFile;

class Product extends ActiveRecord
{
    const SCENARIO_SEARCH = 'search';

    /**
     *
     * @var UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return 'product';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SEARCH] = ['title', 'categories', 'vendor_id'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['title', 'desc', 'vendor_id', 'categories'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['image'], 'string'],
            [['imageFile'], 'file',  'extensions' => 'png, jpg'],
            [['imageFile'], 'safe'],
            [['title'], 'unique', 'targetAttribute' => ['title', 'vendor_id'], 'message' => 'Vendor already have such product!'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Product Name',
            'categories' => 'Product Categories',
            'image' => 'Product Image',
            'desc' => 'Product Description',
            'imageFile' => 'Upload Image',
            'vendor_id' => 'Product Vendor',
        ];
    }

    public function upload()
    {
        if ($this->validate() && $this->imageFile)
        {
            $imageName = 'images/product/product_' . $this->id . '.' . $this->imageFile->extension;
            if (file_exists($imageName))
            {
                unlink($imageName);
            }
            $this->imageFile->saveAs($imageName);
            $this->image = '/' . $imageName;
            $this->imageFile = '';
            return true;
        }
        else
        {
            return false;
        }
    }

    public function setCategories($categories)
    {
        $this->categories = (array) $categories;
    }

    public function getCategoriesString()
    {
        $resultStr = '';
        foreach ($this->categories as $category)
        {
            if ($resultStr)
            {
                $resultStr .= ', ' . $category->title;
            }
            else
            {
                $resultStr = $category->title;
            }
        }
        return $resultStr;
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
                ->viaTable('category_product', ['product_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes) {
        $oldIds = ArrayHelper::map(Product::findOne($this->id)->categories, 'id', 'id');
        parent::afterSave($insert, $changedAttributes);
        foreach ($oldIds as $id)
        {
            if (!in_array($id, $this->categories))
            {
                $this->unlink('categories', Category::findOne($id), true);
            }
        }
        foreach ($this->categories as $id)
        {
            if (!in_array($id, $oldIds))
            {
                $this->link('categories', Category::findOne($id));
            }
        }
    }

    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    public function delete() {
        foreach ($this->categories as $category)
        {
            $this->unlink('categories', $category, true);
        }
        parent::delete();
    }
}