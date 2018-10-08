<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FormulirModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formulir-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_formulir')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
