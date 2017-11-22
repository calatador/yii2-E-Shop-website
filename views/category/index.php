<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'eStore - Categories List';
$this->params['breadcrumbs'][] = 'Categories';
?>

<div class="category-index">
    <h1>Categories</h1>
    <p><?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($data) 
                {
                    return Html::a($data->title, ['view', 'id' => $data->id]);
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