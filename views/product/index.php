<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Vendor;
use app\models\Category;

$this->title = 'eStore - Products List';
$this->params['breadcrumbs'][] = 'Products';
?>

<div class="category-index">
    <h1>Products</h1>
    <p><?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'vendor_id',
                'filter' => ArrayHelper::map(Vendor::find()->asArray()->all(), 'id', 'title'),
                'value' => function($data) {
                    return $data->vendor->title;
                }
            ],
            [
                'attribute' => 'categories',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title'),
                
                'value' => function($data) {
                    if (!$data->categories)
                    {
                        return 'No categories assigned!';
                    }
                    return $data->categoriesString;
                }
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($data) 
                {
                    return Html::a($data->title, ['view', 'id' => $data->id]);
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($data)
                {
                    if ($data->image)
                    {
                        return Html::img($data->image, ['height' => '64px']);
                    }
                    return Html::img('@web/images/product/no_image.png', ['height' => '64px']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>