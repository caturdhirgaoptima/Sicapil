<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form">

    <?php $form = ActiveForm::begin(); ?>
  
    <?= $form->field($model, 'user_username',['options' => ['class' => 'col']])->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'user_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_level')->dropDownList([ 'superadmin' => 'Superadmin', 'verifikator' => 'Verifikator', 'public' => 'Public', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_layanan')->dropDownList(
        $layanan,
        ['prompt'=>'']
        ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
