<?php
  use yii\helpers\Url;
  $this->title = 'Tes';
?>

<div class="p-5">
  <h3 class="text-center text-uppercase font-weight-bold ">Administrasi Publik DISDUKCAPIL</h3>
  <div class="container">
    <?php
      for($i=0 ; $i< count($data) ; $i++){
        echo '
          <a class="text-dark m-3" href="'.Url::home().'/admpublik/layanan?idLayanan='.$data[$i]->id.'">
            <div class="card flex-row flex-wrap">
                <div class="card-header border-0">
                    <img src="'.Url::base().'/image/course_1.jpg" alt="" style="width:300px;height:200px;">
                </div>
                <div class="card-block px-2 my-2">
                    <h4 class="card-title">'.$data[$i]->nama_layanan.'</h4>
                    <p class="card-text">Description</p>
                </div>
                <div class="w-100"></div>
                <div class="card-footer w-100 text-muted">
                    *Syarat
                </div>
            </div>
          </a>
        ';
      }
    ?>
  </div>
</div>
