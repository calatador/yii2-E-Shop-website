<?php
use yii\helpers\Html;

$this->title = 'eStore - Products | Update Product | ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => '/product'];
$this->params['breadcrumbs'][] = 'Update Product ' . $model->title;
?>

<div class='category-create'>
    <h1>Update <?= Html::encode($model->title); ?></h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>