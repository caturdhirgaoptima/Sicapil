<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\BackendAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use kartik\growl\Growl;
BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>SiCapil | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <?php foreach(Yii::$app->session->getAllFlashes() as $message){ ?>
        <?php
            echo Growl::widget([
                    'type' => (!empty($message['type'])) ? $message['type']: 'success',
                    'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Pemberitahuan',
                    'icon' => (!empty($message['icon'])) ? $message['icon'] : 'glyphicon glyphicon-ok',
                    'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Tidak ada pesan',
                    'delay' => 1,
                    'showSeparator' => true,
                    'pluginOptions' => [
                        'delay' => (!empty($message['duration'])) ? $message['duration'] : '3000',
                        'placement' => [
                            'from' => (!empty($message['positionY'])) ? $message['positionY'] : 'top',
                            'align' => (!empty($message['positionX'])) ? $message['positionX'] : 'right',
                        ]
                    ],
                    'useAnimation' =>true
                ]);

        ?>
<?php } ?>
<?php $this->beginBody() ?>

    <div class="wrapper">
        <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SiCapil</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
     
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=Url::base(true).'/images/user.png'?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=Yii::$app->user->identity['user_name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=Url::base(true).'/images/user.png'?>" class="img-circle" alt="User Image">

                <p>
                  <?=Yii::$app->user->identity['user_name']?>
                  <small><?=Yii::$app->user->identity['user_level']?></small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
               
                   <?=Html::beginForm(['/site/logout'], 'post')?>
                                <button type="submit" class="btn btn-default btn-flat">
                                    Keluar
                                </button>
                         <?=Html::endForm()?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
      
        <li class="<?=$this->title=='Beranda'?'active':''?>">
          <a href="<?=Url::base(true).'/@/beranda'?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>

         <li class="<?=$this->title=='Verifikasi'?'active':''?>">
          <a href="<?=Url::base(true).'/@/verifikasi'?>">
            <i class="fa fa-check"></i> <span>Verifikasi</span>
          </a>
        </li>
       
      
       
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

 
        <?= $content ?>
   

    <footer class="main-footer">
  
    <strong>Copyright &copy; 2018 PT. CDO
  </footer>
    
    </div>


<?php $this->endBody() ?>
</body>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

</html>
<?php $this->endPage() ?>
