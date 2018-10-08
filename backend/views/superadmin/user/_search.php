<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_username') ?>

    <?= $form->field($model, 'user_password') ?>

    <?= $form->field($model, 'user_name') ?>

    <?= $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_level') ?>

    <?php // echo $form->field($model, 'user_authKey') ?>

    <?php // echo $form->field($model, 'id_layanan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
