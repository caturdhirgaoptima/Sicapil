<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UrusanModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="urusan-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_urusan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
