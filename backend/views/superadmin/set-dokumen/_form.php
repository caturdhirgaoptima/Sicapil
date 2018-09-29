<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignmentModel */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$select2Options = [
    'multiple' => false,
    'theme' => 'krajee',
    'placeholder' => 'Pilih Urusan',
    'language' => 'en-US',
    'width' => '100%',
];

?>
<div class="auth-assignment-model-form">
<div class="form-group" id="dokumen-ajax">
<?=Select2::widget([
    'name' => 'dokumen',
    'value' => '',
    'disabled' => true,
    'data' => $listDokumen,
    'options' => ['multiple' => false, 'placeholder' => 'Pilih Layanan dan Urusan']
]);?>
</div>


<hr>
<div class="form-group">
<?=Select2::widget([
    'name' => 'layanan',
    'value' => '',
    'data' => $listLayanan,
    'options' => ['multiple' => false, 'placeholder' => 'Pilih Layanan'],
    'pluginEvents' => [
                'select2:select' => 'function(e) { populateUrusan(e.params.data.id); }',
    ],
]);?>
</div>

<div class="form-group">
<?=Select2::widget([
    'name' => 'urusan',
    'value' => '',
    'disabled' => true,
    'data' => $listLayanan,
    'options' => ['multiple' => false, 'placeholder' => 'Pilih Urusan'],
    'pluginEvents' => [
                'select2:select' => 'function(e) { ajaxDokumen(); }',
    ],
]);?>
</div>

<hr>



 



 <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            function populateUrusan(id) {
                var url = '<?= Url::to(['/$/master-dokumen/set-dokumen/populate-urusan/-id-']) ?>';
                var $select = $("select[name='urusan']");
                $select.prop('disabled',false);
                 $select.find('option').remove().end();
                $.ajax({
                    url: url.replace('-id-', id),
                    success: function (data) {
                        var select2Options = <?= Json::encode($select2Options) ?>;
                        select2Options.data = data.data;
                        $select.select2(select2Options);
                        $select.val(data.selected).trigger('change');
                    }
                });
               
            }

            
            function ajaxDokumen(){

                    var $ajax = $('#dokumen-ajax');
                    $ajax
                    var id = $("select[name='urusan']").val();
                    var id2 = $("select[name='layanan']").val();
                   var url = '<?=Url::to(["/$/master-dokumen/set-dokumen/dokumen-ajax?id=-id-&id2=-id2-"])?>';
                    url = url.replace('-id-', id);
                  url = url.replace('-id2-', id2);
                  
                    $ajax.load(url)
               
                
           }

           $(document).ready(function(){
                $(".btn-success").on('click',function(){
                    var layanan = $("select[name='layanan']").val();
                    var urusan = $("select[name='urusan']").val();
                    var dokumen = $("select[name='dokumen[]']").val();
                    $.post("<?=Url::to(['/$/master-dokumen/set-dokumen/post-dokumen'])?>",{layanan:layanan,urusan:urusan,dokumen:dokumen},function(){
                        window.location.reload();
                    });
                });
           });
        </script>
<?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean()), View::POS_END); ?>



    <div class="form-group">
        <?= Html::Button('Save', ['class' => 'btn btn-success']) ?>
    </div>



</div>
