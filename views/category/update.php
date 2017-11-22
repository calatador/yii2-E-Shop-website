<?php
use yii\helpers\Html;

$this->title = 'eStore - Categories | Update Category | ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => '/category'];
$this->params['breadcrumbs'][] = 'Create Category';
?>

<div class='category-update'>
    <h1>Update Category <?= Html::encode($model->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>