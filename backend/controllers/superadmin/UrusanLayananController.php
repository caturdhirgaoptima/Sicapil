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
class UrusanLayananController extends \yii\web\Controller
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

    public function actionIndex($id)
    {
        if(!Yii::$app->user->can('set-urusanlayanan'))
             throw new ForbiddenHttpException;

    	$layanan = LayananModel::find()->where(['id' => $id])->one();
    	$urusan = UrusanModel::find()->all();
    	$listUrusan = ArrayHelper::map($urusan, 'id','nama_urusan');
    	$urusanlayanan = UrusanlayananModel::find()->where(['id_layanan' => $id])->all();
    	$formulir = FormulirModel::find();
    	$value = [];
    	foreach($urusanlayanan as $ul)
    		$value[] = $ul->id_urusan;


    	if(Yii::$app->request->post()){
    		$urusan = Yii::$app->request->post('urusan');
    		$layanan = Yii::$app->request->post('id_layanan');
    		
    		UrusanLayananModel::deleteAll("id_layanan='$layanan'");
    		
    		foreach($urusan as $ur){
    			$model = new UrusanlayananModel();
    			$model->id_layanan = $layanan;
    			$model->id_urusan = $ur;
    			$model->save();
    		}
    		 Yii::$app->getSession()->setFlash('success', [
                    'message' => "Berhasil Memperbarui Urusan Layanan",
                    'title' => 'Urusan Layanan',
                ]);  

    		 return $this->redirect(['/$/master-layanan/layanan']);

    	}
        return $this->render('index',
        	[
        		'layanan' => $layanan,
        		'urusan' => $listUrusan,
        		'value' => $value,
        	]
    	);
    }

}
