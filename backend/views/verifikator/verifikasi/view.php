<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\UserFormulirValueModel;
use backend\models\DokumenUserModel;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\UserModel */

$this->title = 'Verifikasi';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
        <?=$this->title?>
        <small>Verifikasi</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-check"></i>Verifikasi</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-md-8">
                 <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Detail Keperluan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                 
                   <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label' => 'Nama Pengaju',
                                'value' => $model->user->user_name
                            ],
                            [
                                'attribute' => 'id_urusanlayanan',
                                'value' => $model->urusanlayanan->urusan->nama_urusan
                            ],
                            
                            'tanggal:date',
                            'status',


                        ],
                    ]) ?>

                    </div>
            <!-- /.box-body -->
          </div>
            <?php $form = ActiveForm::begin(); ?>
            <?php $i=0; foreach($model->urusanlayanan->formulirUrusanlayanans as $form){ ?>
              <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title"><?=$form->formulir->nama_formulir?></h3>
                      <div style="float: right;">
                        <input type="radio" name="cek[<?=$form->formulir->nama_formulir?>]" value="terima" class="cek"><i class="fa fa-check"></i>
                        &nbsp &nbsp
                        <input type="radio" name="cek[<?=$form->formulir->nama_formulir?>]" value="tolak" class="cek"><i class="fa fa-times"></i>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                            $label = UserFormulirValueModel::find()->joinWith('dataformulir', 'userFormulirValue.id_dataformulir = dataformulir.id')
                            ->andWhere(['id_formulir' =>$form->formulir->id])
                            ->andWhere(['id_urusanlayanan_user' => $model->id])->all();
                            
                        ?>
                        <table class="table table-striped">
                           <?php foreach($label as $lab){ ?> 

                                <tr>
                                    <td><?=$lab->dataformulir->nama_data?></td>
                                    <td><?=$lab->value?></td>
                              
                                </tr>
                            <?php } ?>

                        </table>

                    </div>
                    <div class="form-group box-body alasan" style="display: none">
                      <label>Alasan</label>
                      <textarea class="form-control" name="alasan[<?=$form->formulir->nama_formulir?>]"></textarea>
                    </div>
            <!-- /.box-body -->
          </div>
          <?php $i++; } ?>


          
              <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dokumen</h3>
                       <div style="float: right;">
                        <input type="radio" name="cek[dokumen]" value="terima" class="cek"><i class="fa fa-check"></i>
                        &nbsp &nbsp
                        <input type="radio" name="cek[dokumen]" value="tolak" class="cek"><i class="fa fa-times"></i>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <?php foreach($dokumen as $dok){ ?>

                      <a class="example-image-link" href="<?=Yii::$app->params['front'].'/'.$dok->file_dokumen?>" data-lightbox="example-1" style="margin-right: 15px" data-title="<?=$dok->dokumen->nama_dokumen?>"><img class="example-image" src="<?=Yii::$app->params['front'].'/'.$dok->file_dokumen?>" alt="image-1" width="40" height="60" /></a>
                      <?php } ?>
                      
                    </div>
                     <div class="form-group box-body alasan" style="display: none">
                      <label>Alasan</label>
                      <textarea class="form-control" name="alasan[dokumen]"></textarea>
                    </div>
            <!-- /.box-body -->
          </div>
      
        </div>
      </div>
       <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
      <?php ActiveForm::end(); ?>
      
    </section>
    <!-- /.content -->
  </div>
<?php
$this->registerJsFile(
    '@web/js/lightbox.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<?php $this->registerCssFile(Url::base(true) . '/css/lightbox.min.css'); ?>
  <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            $(".cek").on('change',function(){
                var cek = $(this).val();
                if(cek=="tolak"){
                    $div = $(this).parent().parent().parent();
                    $alasan = $div.find('.alasan');
                    $alasan.prop('style','');
                }
            });
            
        </script>
<?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean()), View::POS_END); ?>