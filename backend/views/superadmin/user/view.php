<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserModel */

$this->title = 'User';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$this->title?>
        <small>Master User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i>Master User</a></li>
        <li class="active">User</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-md-7">
                 <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Detail user</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                             <p>
                        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
                            'user_username',
                            'user_name',
                            'user_email:email',
                            'user_level',
                            [
                                'attribute' => 'id_layanan',
                                'value' => function($model){
                                    return $model->layanan->nama_layanan;
                                }
                            ],
                            
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