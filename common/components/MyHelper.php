<?php
namespace common\components;
use yii;
use yii\helpers\Url;
use common\models\User;
use app\models\admin\TahunAnggaran; 
use yii\web\ForbiddenHttpException;
use app\models\Riwayat;

class MyHelper  {
    public static function hashPassword($pass){

        for($i=0;$i<64;$i++){
            $pass = md5($pass);
            for($j=0;$j<52;$j+=2)
                $pass = base64_encode($pass);
        }
        $pass = md5($pass);
        return Yii::$app->getSecurity()->generatePasswordHash($pass);
    }

    public function validatePassword($pass, $hash){
        for($i=0;$i<64;$i++){
            $pass = md5($pass);
            for($j=0;$j<52;$j+=2)
                $pass = base64_encode($pass);
        }
        $pass = md5($pass);

        return Yii::$app->getSecurity()->validatePassword($pass, $hash);
    }


    public function cekTahunAnggaran(){
        $tahun = TahunAnggaran::getBerjalan();
        if($tahun['tahun_anggaran'] != date('Y')){
            throw new ForbiddenHttpException;
        }
    }


    public function add_history($max_id, $detail,$tabel,$attr,$aksi){
            if($aksi!='delete')
                $str = implode (", ", $attr);                

                $riwayat = new Riwayat();
                $tahun = TahunAnggaran::getBerjalan();          
                $data = array(
                    'user_id' => Yii::$app->user->identity['user_id'],
                    'id_terkait' => $max_id,
                    'riwayat_uraian' => $detail.': '.@$str,
                    'tahun_anggaran' => $tahun['tahun_anggaran'],
                    'tabel' => $tabel,
                    'aksi' => $aksi

                );
                $riwayat->attributes = $data;
                $riwayat->save();
    }

   
}