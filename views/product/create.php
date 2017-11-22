<?php
use yii\helpers\Html;

$this->title = 'eStore - Products | Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => '/product'];
$this->params['breadcrumbs'][] = 'Create Product';
?>

<div class='category-create'>
    <h1>Create Product</h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>