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
use backend\models\FormulirUrusanlayananModel;
use yii\web\Response;

class SetFormulirController extends \yii\web\Controller
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

    	if(!Yii::$app->user->can('set-formulir'))
             throw new ForbiddenHttpException;

    	$layanan = LayananModel::find()->where("nama_layanan != 'master'")->all();
    	$listLayanan = ArrayHelper::map($layanan,'id','nama_layanan');
        return $this->render('index',
        	[
        		'listLayanan' => $listLayanan,
        	]
    	);
    }


       public function actionPopulateUrusan($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $urusan = UrusanModel::find()->joinWith('urusanlayanans','urusan.id=urusanlayanans.id_urusan')->where(['id_layanan' => $id])->all();
        $data = [['id' => '', 'text' => '']];
      
        foreach ($urusan as $urus) {
            $data[] = ['id' => $urus->id, 'text' => $urus->nama_urusan];
        }
        return ['data' => $data];
    }


    public function actionFormulirAjax(){

    	if(!Yii::$app->user->can('set-formulir'))
             throw new ForbiddenHttpException;

        $id = Yii::$app->request->get('id');
        $id2 = Yii::$app->request->get('id2');
        $formulir = FormulirModel::find()->joinWith('formulirUrusanlayanans','formulir.id=formulirUrusanlayanans.id_formulir')
                    ->joinWith('formulirUrusanlayanans.urusanlayanan','urusanlayanans.id = formulirUrusanlayanans.id_urusanlayanan')
                ->andWhere(['id_urusan' => $id])->andWhere(['id_layanan' => $id2])->all();
            $value= [];
        foreach($formulir as $dok){
            $value[] = $dok->id;
        }
        $formulir = FormulirModel::find()->all();
        $listFormulir = ArrayHelper::map($formulir,'id','nama_formulir');
        return $this->renderAjax('formulir',['formulir' => $listFormulir, 'value' => $value]);
    }



     public function actionPostFormulir(){

     	if(!Yii::$app->user->can('set-formulir'))
             throw new ForbiddenHttpException;
             
            $id_layanan = Yii::$app->request->post('layanan');
            $id_urusan = Yii::$app->request->post('urusan');
            $id_formulir = Yii::$app->request->post('formulir');

 
            $id = UrusanlayananModel::find()->andWhere(['id_layanan' => $id_layanan])->andWhere(['id_urusan' => $id_urusan])->one();
            FormulirUrusanlayananModel::deleteAll("id_urusanlayanan=$id->id");
            foreach($id_formulir as $dok){
                $model = new FormulirUrusanlayananModel();
                $model->id_formulir = $dok;
                 $model->id_urusanlayanan = $id->id;
                 $model->save();
            }

            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Formulir Berhasil Diset",
                    'title' => 'Set Formulir',
                ]);  
                return 1;
    }

}
