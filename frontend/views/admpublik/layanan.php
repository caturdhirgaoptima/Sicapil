<?php
  use yii\helpers\Url;
  $this->title = 'Tes';
?>


<div class="container p-3">
  <h3 class="text-center text-uppercase font-weight-bold ">Layanan <?php echo $layanan->nama_layanan ?></h3>

  <?php

    for($i=0 ; $i< count($data) ; $i++){
      echo '
        <div class="card my-3">
          <div class="card-header">
            <span class="font-weight-bold">'.$data[$i]->urusan['nama_urusan'].'</span>
          </div>
          <div class="card-body">
            <h5 class="card-title">Persyaratan :</h5>
            <ul class="list-group list-group-flush">
      ';
      $syarat = $data[$i]->getTableUrusanSyarats()->all();
      for($j=0 ; $j< count($syarat) ; $j++){
        echo '
              <li class="list-group-item"><i class="fa fa-circle"></i> '.$syarat[$j]->syarat.'</li>
        ';
      }
      echo '
            </ul>
          </div>
          <div class="card-footer text-muted text-center">
            <a href="'.Url::home().'/admpublik/uploaddokumen?idLayanan='.$layanan->id.'&idUrusan='.$data[$i]->urusan['id'].'" class="btn btn-primary">Upload Dokumen</a>
          </div>
        </div>
      ';
    }

  ?>

</div>
