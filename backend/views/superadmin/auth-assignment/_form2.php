<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignmentModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-model-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?=$user->user_username?>" disabled>
            <input type="hidden" class="form-control" value="<?=$user->user_id?>" name="username">
    </div>
    
<div class="form-group">
<?=Select2::widget([
    'name' => 'akses',
    'value' => $value,
    'data' => $akses,
    'options' => ['multiple' => true, 'placeholder' => 'Pilih Hak Akses']
]);?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
