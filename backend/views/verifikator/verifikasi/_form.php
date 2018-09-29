<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model backend\models\UrusanlayananUserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="urusanlayanan-user-model-form">
     <div class="callout callout-info">
        <h4>
             <table>
                <tr>
                    <td style="padding-right: 20px">ID Transaksi</td><td><?=$model->id?></td>
                </tr>
                <tr>
                     <td style="padding-right: 20px">Nama</td><td><?=$model->user->user_name?></td>
                </tr>
                
            </table>
        </h4>
       
      </div>
   
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" name="UrusanlayananUserModel[id]" value="<?=$model->id?>">
    <?= $form->field($model, 'status')->radioList(array('verifikasi' =>'Verifikasi','ditolak'=>'Ditolak')); ?>
   
   <div class="form-group">
    <label>Pesan</label>
    <textarea name="UrusanlayananUserModel[komentar]" id="isi" class="form-control" rows="6">
     
    </textarea>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            $('#urusanlayananusermodel-status').on('click',function(){
                var status = $("input[name='UrusanlayananUserModel[status]']:checked").val();
                console.log(status);
                $('#isi').empty();
                if(status=='verifikasi'){
                    $('#isi').append("Berkas Anda sudah diverifikasi. Silahkan bawa berkas asli ke kantor Disdukcapil");
                }else if(status=='ditolak'){
                     $('#isi').append("Alasan Ditolak... ");
                }
            });

            
        </script>
<?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean()), View::POS_END); ?>