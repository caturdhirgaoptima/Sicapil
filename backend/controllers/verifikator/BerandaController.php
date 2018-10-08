<?php

namespace backend\controllers\verifikator;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use backend\models\DokumenModel;
use backend\models\LayananModel;
use backend\models\UserModel;
use backend\models\UrusanlayananUserModel;
/**
 * DataAkunController implements the CRUD actions for DataAkun model.
 */
class BerandaController extends Controller
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



    public function actionIndex(){
    
   
       $formulir = UrusanlayananUserModel::find()->count();
       $this->layout = "main-ver";
       return $this->render('index',
            [
           
            
                'formulir' => $formulir,
            ]
        );
    }

}