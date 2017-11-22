<?php
use yii\helpers\Html;

$this->title = 'eStore - Vendors | Create Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => '/vendor'];
$this->params['breadcrumbs'][] = 'Create Vendor';
?>

<div class='vendor-create'>
    <h1>Create Vendor</h1>
    <?= $this->render('_form', [
        'model' => $model
    ]); ?>
</div>