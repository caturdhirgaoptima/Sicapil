<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserModel */

$this->title = 'Dokumen';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$this->title?>
        <small>Master Dokumen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i>Master Dokumen</a></li>
        <li class="active">Dokumen</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-md-7">
                 <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Detail Dokumen</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                       
                            'nama_dokumen',
                        ],
                    ]) ?>

                    </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      
    </section>
    <!-- /.content -->
  </div>