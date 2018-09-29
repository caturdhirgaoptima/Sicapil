<?php

namespace backend\controllers\verifikator;

use Yii;
use backend\models\UrusanlayananUserModel;
use backend\models\UrusanlayananUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\DokumenUserModel;
use backend\models\FormulirModel;
/**
 * VerifikasiController implements the CRUD actions for UrusanlayananUserModel model.
 */
class VerifikasiController extends Controller
{
    /**
     * @inheritdoc
     */
        public function behaviors()
    {
         return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function($rule, $action) {
                                    return Yii::$app->user->can('verifikator');
                                }
                        ],
                    ],
                ],
            ];
    }

    /**
     * Lists all UrusanlayananUserModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UrusanlayananUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = "main-ver";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UrusanlayananUserModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model =$this->findModel($id);
        $dokumen = DokumenUserModel::find()->where(['id_urusanlayanan_user' => $model->id])->all();
        $form =  FormulirModel::find()->joinWith('formulirUrusanlayanans','formulirUrusanlayanans.id_formulir=formulir.id')
                    ->where(['id_urusanlayanan' => $model->id_urusanlayanan])->all();
      
        if(Yii::$app->request->post()){
            $cek = Yii::$app->request->post('cek');
            $alasan = Yii::$app->request->post('alasan');
         
            if(in_array('tolak', $cek)){
                $message = "
                    <p>Mohon maaf sdr. ".$model->user->user_name.", Keperluan Anda dengan kode #".$model->id." Ditolak.</p>
                    <p>Hal ini Dikarenakan : </p>";
                $alas = "<ul>";
                foreach($form as $fo){
                    $alas.= "<li>".$fo->nama_formulir." : ".$alasan[$fo->nama_formulir]."</li>";
                } 
                $alas.= "<li>Dokumen : ".$alasan['dokumen']."</li>";
                $alas.="</ul>";
                $message.=$alas;
                $jadinya = "tolak";
            }else{
                $message = "
                    <p>Selamat, keperluan sdr.".$model->user->user_name." dengan kode #".$model->id.", keperluan Anda telah diverifikasi</p>
                    <p>Berkas Anda sudah diverifikasi. Silahkan bawa berkas asli ke kantor Disdukcapil</p>
                    ";
                $jadinya = "verifikasi";

            }
            $model->status = $jadinya;
            $model->komentar = $message;
            var_dump($model);die;
            if($model->save()){
                Yii::$app->mailer->compose('layouts/html', ['content' => $message])
                ->setFrom('idadi70@gmail.com')
                ->setTo($model->user->user_email)
                ->setSubject('SiCapil - Konfirmasi Keperluan #'.$model->id)
                ->send();

                Yii::$app->getSession()->setFlash('success', [
                        'message' => "Status Berhasil Diubah",
                        'title' => 'Verifikasi Transaksi',
                    ]);  
            }else{
                Yii::$app->getSession()->setFlash('failed', [
                         'type' => 'danger',
                        'icon' => 'glyphicon glyphicon-remove',     
                        'message' => "Status Gagal Diubah",
                        'title' => 'Verifikasi Transaksi',
                    ]);  
            }
            return $this->redirect(['index']);
       
        }
        $this->layout = "main-ver";
        return $this->render('view', [
            'model' => $model,
            'dokumen' => $dokumen,
        ]);
    }

    /**
     * Creates a new UrusanlayananUserModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UrusanlayananUserModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionDownload($id){
    	$dok = DokumenUserModel::find()->where(['id' => $id])->one();
    	 $path = Yii::getAlias('@frontend').'/web/images/upload/'.$dok->file_dokumen;
    	 var_dump($path);
    	 if (file_exists($path)) {
	        return Yii::$app->response->sendFile($path);
	    }else{
	    	Yii::$app->getSession()->setFlash('failed', [
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove',                
                    'message' => "File Tidak Ditemukan",
                    'title' => 'Download Dokumen',
                ]); 
	    	return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	    }
    }
    /**
     * Updates an existing UrusanlayananUserModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          
        	if($model->status == 'ditolak'){
        			$message = "
        			<p>Mohon maaf sdr. ".$model->user->user_name.", Keperluan Anda dengan kode #".$model->id." Ditolak.</p>
        			<p>Hal ini Dikarenakan : </p>
        			<p>".$model->komentar."</p>";		
        	}else if ($model->status == 'verifikasi'){
        			$message = "
        			<p>Selamat, keperluan sdr.".$model->user->user_name." dengan kode #".$model->id.", keperluan Anda telah diverifikasi</p>
        			<p>".$model->komentar."</p>
        			";
        	}
        
        	Yii::$app->mailer->compose('layouts/html', ['content' => $message])
			    ->setFrom('idadi70@gmail.com')
			    ->setTo($model->user->user_email)
			    ->setSubject('SiCapil - Konfirmasi Keperluan #'.$model->id)
			    ->send();

        	Yii::$app->getSession()->setFlash('success', [
                    'message' => "Status Berhasil Diubah",
                    'title' => 'Verifikasi Transaksi',
                ]);  
            return $this->redirect(['index']);
        }
        $this->layout = "main-ver";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UrusanlayananUserModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UrusanlayananUserModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UrusanlayananUserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UrusanlayananUserModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
