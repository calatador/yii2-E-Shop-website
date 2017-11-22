<?php
use yii\helpers\Html;

$this->title = 'eStore - Categories | Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => '/category'];
$this->params['breadcrumbs'][] = 'Create Category';
?>

<div class='category-create'>
    <h1>Create Category</h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>