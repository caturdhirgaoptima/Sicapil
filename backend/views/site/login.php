<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<style type="text/css">
   
    .intro{
         background-color: rgba(0,0,0,0.45);
    }

    .checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
</style>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>SiCapil</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masukkan Username dan Password</p>

     <?php $form = ActiveForm::begin() ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="LoginForm[username]">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <p><?=$model->getFirstError('username')?></p>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="LoginForm[password]">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <p><?=$model->getFirstError('password')?></p>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="0" name="LoginForm[rememberMe]">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                       Ingat Saya
                                      </label>
                                    </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    <?php ActiveForm::end(); ?>

   
    <!-- /.social-auth-links -->

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->