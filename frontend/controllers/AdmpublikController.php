<?php

namespace frontend\controllers;
use frontend\models\TableUrusanLayanan;
use frontend\models\TableLayanan;
use frontend\models\TableUrusanSyarat;
use frontend\models\TableDokumenUrusanlayanan;
use frontend\models\TableDokumenUser;
use frontend\models\TableUrusanlayananUser;

class AdmpublikController extends \yii\web\Controller
{
    public $layout = 'sicapillayout';
    public function actionIndex()
    {
        $data = TableLayanan::find()->all();
        $this->view->params['active'] = 'admpublik';
        return $this->render('index',[
          'data' => $data
        ]);
    }

    public function actionLayanan($idLayanan)
    {
        $data = TableUrusanLayanan::find()
          ->where(['id_layanan' => $idLayanan])
          ->all();
        $layanan = TableLayanan::find()
          ->where(['id' => $idLayanan])
          ->one();
        $this->view->params['active'] = 'admpublik';
        return $this->render('layanan',[
          'data' => $data,
          'layanan' => $layanan
        ]);
    }

    public function actionUploaddokumen($idUrusan, $idLayanan){
      $this->view->params['active'] = 'admpublik';

      $data = TableUrusanLayanan::find()
        ->where(['id_layanan' => $idLayanan])
        ->where(['id_urusan' => $idUrusan])
        ->one();
      $dokumenUrusanLayanan = TableDokumenUrusanlayanan::find()
        ->where(['id_urusanlayanan' => $data->id])
        ->all();
      $syarat = $data->getTableUrusanSyarats()->all();

      return $this->render('uploaddokumen',[
        'data' => $data,
        'dokumenUrusanLayanan' => $dokumenUrusanLayanan
      ]);
    }

    public function actionUploadingdokumen(){
      $data = TableUrusanLayanan::find()
        ->where(['id_layanan' => $_POST['idLayanan']])
        ->where(['id_urusan' => $_POST['idUrusan']])
        ->one();
      $dokumenUrusanLayanan = TableDokumenUrusanlayanan::find()
        ->where(['id_urusanlayanan' => $data->id])
        ->all();

      $userlayanan = new TableUrusanlayananUser();
      $userlayanan->id_user = 1;
      $userlayanan->id_urusanlayanan = $data->id;
      $userlayanan->tanggal = date("Y-m-d");
      $userlayanan->save();

      $target_dir = "uploads/";
      $uploadOk = 1;

      for($i=0 ; $i< count($dokumenUrusanLayanan) ; $i++){

        $target_file = $target_dir . basename($_FILES[$dokumenUrusanLayanan[$i]->dokumen['field_name']]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES[$dokumenUrusanLayanan[$i]->dokumen['field_name']]["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        // if ($_FILES[$dokumenUrusanLayanan[$i]->dokumen['field_name']]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "pdf" ) {
            echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$dokumenUrusanLayanan[$i]->dokumen['field_name']]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES[$dokumenUrusanLayanan[$i]->dokumen['field_name']]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

      }

      return $this->redirect(['lacakberkas/detail']);

    }

}
