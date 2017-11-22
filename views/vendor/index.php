<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'eStore - Vendors List';
$this->params['breadcrumbs'][] = 'Vendors';
?>

<div class="vendor-index">
    <h1>Vendors</h1>
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