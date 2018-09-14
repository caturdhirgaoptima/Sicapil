<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

 <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"><?= Html::encode($this->title) ?></h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! <?=Html::encode($message)?>.</h3>

          <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

          
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->