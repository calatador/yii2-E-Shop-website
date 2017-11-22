<?php
use yii\helpers\Html;

$this->title = 'eStore - Vendors | Update Vendor | ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => '/vendor'];
$this->params['breadcrumbs'][] = 'Create Vendor';
?>

<div class='vendor-update'>
    <h1>Update Vendor <?= Html::encode($model->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>