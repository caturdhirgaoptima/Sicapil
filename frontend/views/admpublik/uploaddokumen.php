<?php
  use yii\helpers\Url;
  $this->title = 'Tes';
?>

<div class="container p-3">
  <h3 class="text-center">UPLOAD DOKUMEN</h3>
  <div class="card">
    <div class="card-header font-weight-bold">
      <?php
        echo $data->urusan['nama_urusan'];
      ?>
    </div>
    <form method="post" action="<?php echo Url::home() ?>/admpublik/uploadingdokumen" enctype="multipart/form-data">

      <div class="card-body">
        <h5 class="card-title">Dokumen yang dibutuhkan :</h5>

          <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
          <input type="hidden" name="idUrusan" value="<?php echo $data->urusan['id']; ?>" />
          <input type="hidden" name="idLayanan" value="<?php echo $data->layanan['id']; ?>" />

          <?php
            for($i=0 ; $i< count($dokumenUrusanLayanan) ; $i++){
              echo '
                <div class="form-group">
                  <label>'.$dokumenUrusanLayanan[$i]->dokumen['nama_dokumen'].'</label>
              ';
              if($dokumenUrusanLayanan[$i]->dokumen['downloadable'] != "-"){
                  echo '(Bagi yang belum memiliki Form '.$dokumenUrusanLayanan[$i]->dokumen['nama_dokumen'].'. Silahkan download dengan cara klik disini)';
              }
              echo '
                  <input type="file" class="form-control-file" name="'.$dokumenUrusanLayanan[$i]->dokumen['field_name'].'">
                  <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                </div>
              ';
            }

          ?>

      </div>

      <div class="card-footer text-muted text-center">
        <button type="submit" class="btn btn-primary">UPLOAD</button>
      </div>

    </form>
  </div>
</div>
