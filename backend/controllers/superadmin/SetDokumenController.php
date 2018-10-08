<?php

namespace backend\controllers\superadmin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use backend\models\LayananModel;
use backend\models\UrusanModel;
use backend\models\UrusanlayananModel;
use backend\models\FormulirModel;
use backend\models\DokumenModel;
use backend\models\DokumenUrusanlayananModel;
use yii\web\Response;

class SetDokumenController extends \yii\web\Controller
{

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
                                    return Yii::$app->user->can('superadmin');
                                }
                        ],
                    ],
                ],
            ];
    }


    public function actionIndex()
    {
        if(!Yii::$app->user->can('set-dokumen'))
             throw new ForbiddenHttpException;

    	$layanan = LayananModel::find()->where("nama_layanan != 'master'")->all();
    	$listLayanan = ArrayHelper::map($layanan,'id','nama_layanan');
    	$dokumen = DokumenModel::find()->all();
    	$listDokumen = ArrayHelper::map($dokumen,'id','nama_dokumen');


    	if(Yii::$app->request->post()){
    		$id_layanan = Yii::$app->request->post('layanan');
    		$id_urusan = Yii::$app->request->post('urusan');
    		$id_dokumen = Yii::$app->request->post('dokumen');
    		$model = new DokumenUrusanlayananModel();
    		$id = UrusanlayananModel::find()->andWhere(['id_layanan' => $id_layanan])->andWhere(['id_urusan' => $id_urusan])->one();
    		$model->id_urusanlayanan = $id->id;
    		$model->id_dokumen = $id_dokumen;
    		if($model->save()){
    			 Yii::$app->getSession()->setFlash('success', [
                    'message' => "Dokumen Berhasil Diset",
                    'title' => 'Set Dokumen',
                ]);  
    			 return $this->redirect(['index']);
    		}else{
    			 Yii::$app->getSession()->setFlash('failed', [    
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove',                
                    'message' => "Dokumen Gagal Diset",
                    'title' => 'Set Dokumen',
                ]);  
    			
    		}
    	}
        return $this->render('index',
        	[
        		'layanan' => $layanan,
        		'listLayanan' => $listLayanan,
        		'listDokumen' => $listDokumen,
        	]
    	);
    }

    public function actionPostDokumen(){
        if(!Yii::$app->user->can('set-dokumen'))
             throw new ForbiddenHttpException;

            $id_layanan = Yii::$app->request->post('layanan');
            $id_urusan = Yii::$app->request->post('urusan');
            $id_dokumen = Yii::$app->request->post('dokumen');

            
            $id = UrusanlayananModel::find()->andWhere(['id_layanan' => $id_layanan])->andWhere(['id_urusan' => $id_urusan])->one();
            DokumenUrusanlayananModel::deleteAll("id_urusanlayanan=$id->id");
            foreach($id_dokumen as $dok){
                $model = new DokumenUrusanlayananModel();
                $model->id_dokumen = $dok;
                 $model->id_urusanlayanan = $id->id;
                 $model->save();
            }

            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Dokumen Berhasil Diset",
                    'title' => 'Set Dokumen',
                ]);  
                return 1;
    }

    public function actionPopulateUrusan($id)
    {
        if(!Yii::$app->user->can('set-dokumen'))
             throw new ForbiddenHttpException;

        Yii::$app->response->format = Response::FORMAT_JSON;
        $urusan = UrusanModel::find()->joinWith('urusanlayanans','urusan.id=urusanlayanans.id_urusan')->where(['id_layanan' => $id])->all();
        $data = [['id' => '', 'text' => '']];
      
        foreach ($urusan as $urus) {
            $data[] = ['id' => $urus->id, 'text' => $urus->nama_urusan];
        }
        return ['data' => $data];
    }


    public function actionDokumenAjax(){

        if(!Yii::$app->user->can('set-dokumen'))
             throw new ForbiddenHttpException;
             
        $id = Yii::$app->request->get('id');
        $id2 = Yii::$app->request->get('id2');
        $dokumen = DokumenModel::find()->joinWith('dokumenUrusanlayanans','dokumen.id=dokumenUrusanlayanans.id_dokumen')
                    ->joinWith('dokumenUrusanlayanans.urusanlayanan','urusanlayanans.id = dokumenUrusanlayanans.id_urusanlayanan')
                ->andWhere(['id_urusan' => $id])->andWhere(['id_layanan' => $id2])->all();
            $value= [];
        foreach($dokumen as $dok){
            $value[] = $dok->id;
        }
        $dokumen = DokumenModel::find()->all();
        $listDokumen = ArrayHelper::map($dokumen,'id','nama_dokumen');
        return $this->renderAjax('dokumen',['dokumen' => $listDokumen, 'value' => $value]);
    }

}
