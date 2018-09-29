<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Verifikasi User</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
               

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'id_user',
                            'value' => 'user.user_name'
                        ],
                        [
                            'attribute' => 'id_urusanlayanan',
                            'value' => 'urusanlayanan.urusan.nama_urusan'
                        ],
                        
                        'tanggal:date',
                        [
                          'attribute' => 'status',
                          'format' => 'raw',
                          'value' => function($model){
                            return $model->statusnya();
                          }
                        ],
                        
                        [
                            'label' => 'Action',
                            'format' => 'raw',
                            'value' => function($model){
                                return $model->verifikasi();
                            }
                        ],
                        //'komentar:ntext',

                   
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>