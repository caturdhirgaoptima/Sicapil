<?php
  use yii\helpers\Url;
  $this->title = 'Tes';
?>

<!-- Home -->

<div class="home">
  <div class="breadcrumbs_container">
    <div class="container">
      <div class="row">
        <div class="col">
          <ul class="breadcrumbs_list d-flex flex-row align-items-center justify-content-start">
            <li><a href="<?php echo Url::home(); ?>/home">Beranda</a></li>
            <li><a href="<?php echo Url::home(); ?>/admpublik">Administrasi Publik</a></li>
            <li><a href="<?php echo Url::home(); ?>/admpublik/layanan?idLayanan=<?php echo $data->layanan['id']; ?>"><?php echo $data->layanan['nama_layanan']; ?></a></li>
            <li><a href="<?php echo Url::home(); ?>/admpublik/urusan?idLayanan=<?php echo $data->layanan['id']; ?>&idUrusan=<?php echo $data->urusan['id']; ?>"><?php echo $data->urusan['nama_urusan']; ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card m-3">
  <div class="card-header text-dark font-weight-bold">
    <?php echo $data->urusan['nama_urusan']; ?>
  </div>
  <div class="card-body">
    <ul class="list-group list-group-flush">
    <?php
      for($i=0 ; $i< count($syarat) ; $i++){
        echo '
          <li class="list-group-item text-dark"><i class="fa fa-circle" aria-hidden="true"></i> '.$syarat[$i]->syarat.'</li>
        ';
      }
    ?>
    </ul>
  </div>
  <div class="card-footer text-center">
    <p class="text-dark">Apabila persyaratan diatas telah dipenuhi maka silahkan upload dokumen dengan menekan tombol dibawah</p>
    <a href="<?php echo Url::home(); ?>/admpublik/uploaddokumen?idLayanan=<?php echo $data->layanan['id']; ?>&idUrusan=<?php echo $data->urusan['id']; ?>" class="btn btn-primary btn-lg active m-2" role="button" aria-pressed="true">UPLOAD DOKUMEN</a>
  </div>
</div>
