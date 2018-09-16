<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignmentModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-model-form">

    <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'user_id')->dropDownList(
        $data,
        ['prompt'=>'']
        ); ?>

        
    <?= $form->field($model, 'item_name')->dropDownList(
        $akses,
        ['prompt'=>'']
        ); ?>
    

  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
