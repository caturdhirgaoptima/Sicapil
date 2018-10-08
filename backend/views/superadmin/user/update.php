<?php

use yii\helpers\Html;


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
		              <h3 class="box-title">Update user</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            		<?= $this->render('_form', [
						        'model' => $model,
						        'layanan' => $layanan,
						    ]) ?>
		            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      
    </section>
    <!-- /.content -->
  </div>