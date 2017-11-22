<?php

use yii\helpers\Html;

$this->title = 'eStore - Vendors | ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['/vendor']];
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
    </p>
    <table class='table table-striped table-bordered'>
        <tbody>
            <tr>
                <th>Short Information: </th>
                <td>Assigned <?= count($model->products); ?> products</td>
            </tr>
        </tbody>
    </table>
</div>