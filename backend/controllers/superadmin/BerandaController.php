<?php

namespace backend\controllers\superadmin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


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
                                'roles' => ['@']
                                
                            ],
                        ],
                    ],
                ];
        }



    public function actionIndex(){
       
       return $this->render('index');
    }

}