<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Vendor;
use app\models\Category;
?>

<div class='product-form'>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'imageFile')->fileInput(); ?>

    <?= $form->field($model, 'image')->textInput(); ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => '10']); ?>

    <?= $form->field($model, 'categories')->checkboxList(
        ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'vendor_id')->dropDownList(
        Vendor::find()->select(['title', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Select Product Vendor']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>