<?php

use yii\helpers\Html;

$this->title = 'eStore - Product | ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['/product']];
$this->params['breadcrumbs'][] = $model->title;
?>

<div class='category-view'>
    <h1><?= Html::encode($model->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <table class='table table-striped table-bordered'>
        <tbody>
            <tr>
                <th><?= $model->attributeLabels()['image']; ?>: </th>
                <td><?= Html::img($model->image); ?></td>
            </tr>
            <tr>
                <th><?= $model->attributeLabels()['categories']; ?></th>
                <td><?= Html::encode($model->categoriesString); ?></td>
            </tr>
            <tr>
                <th><?= $model->attributeLabels()['vendor_id']; ?></th>
                <td><?= Html::encode($model->vendor->title); ?></td>
            </tr>
            <tr>
                <th><?= $model->attributeLabels()['desc']; ?>: </th>
                <td><?= Html::encode($model->desc); ?></td>
            </tr>
        </tbody>
    </table>
</div>