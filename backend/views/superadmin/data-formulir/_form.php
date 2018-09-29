<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataFormulirModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-formulir-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datatype')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
