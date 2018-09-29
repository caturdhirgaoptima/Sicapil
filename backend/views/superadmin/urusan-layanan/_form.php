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
            <label>Layanan</label>
            <input type="text" class="form-control" value="<?=$layanan->nama_layanan?>" disabled>
            <input type="hidden" class="form-control" value="<?=$layanan->id?>" name="id_layanan">
    </div>
    
<div class="form-group">
<?=Select2::widget([
    'name' => 'urusan',
    'value' => $value,
    'data' => $urusan,
    'options' => ['multiple' => true, 'placeholder' => 'Pilih Urusan']
]);?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
