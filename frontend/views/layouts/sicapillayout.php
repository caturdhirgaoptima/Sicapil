<?php
use yii\helpers\Html;
use frontend\assets\BerandaAsset;
use frontend\assets\AdmPublikAsset;
use frontend\assets\LoginAsset;
use frontend\assets\LacakBerkasAsset;
use yii\helpers\Url;

if($this->params['active'] == 'beranda') {
  BerandaAsset::register($this);
}
else if($this->params['active'] == 'admpublik') {
  AdmPublikAsset::register($this);
}
else if($this->params['active'] == 'login') {
  LoginAsset::register($this);
}
else if($this->params['active'] == 'lacakberkas') {
  LacakBerkasAsset::register($this);
}


?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Lingua project">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?= Html::csrfMetaTags() ?>
      <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
  </head>
  <body>
    <header class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" id="tes" href="#">SIAP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:100%;">
        <ul class="navbar-nav mr-auto" style="margin-left:auto; margin-right:auto;">
          <li class="nav-item <?php if($this->params['active']=="beranda"){ echo "active font-weight-bold"; } ?>">
            <a class="nav-link" href="<?php echo Url::home(); ?>">Beranda <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item <?php if($this->params['active']=="admpublik"){ echo "active font-weight-bold"; } ?>">
            <a class="nav-link" href="<?php echo Url::home(); ?>/admpublik">Administrasi Publik</a>
          </li>
          <li class="nav-item <?php if($this->params['active']=="faq"){ echo "active font-weight-bold"; } ?>">
            <a class="nav-link" href="#">Tanya Jawab (FAQ)</a>
          </li>
        </ul>
        <div class="dropdown float-right">

          <?php
            if(Yii::$app->session['logged_in']){
              echo '
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="'.Url::base().'/image/avatar.png" style="width:50px; height:50px;"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Profil</a>
                  <a class="dropdown-item" href="'.Url::home().'/lacakberkas">Lacak Berkas <span class="badge badge-primary">1</span></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Logout</a>
                </div>
              ';
            }else{
              echo '
                <a class="nav-link text-dark" href="'.Url::home().'/login">Login</a>
              ';
            }
          ?>

        </div>
      </div>
    </header>

    <?php $this->beginBody() ?>

      <?= $content ?>

    <?php $this->endBody() ?>

    <!-- Footer -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2018 Copyright
        <a href="https://cdo.co.id" class="text-dark">PT. Catur Dhirga Optima</a>
      </div>
      <!-- Copyright -->

    <!-- Footer -->

  </body>
</html>
<?php $this->endPage() ?>
