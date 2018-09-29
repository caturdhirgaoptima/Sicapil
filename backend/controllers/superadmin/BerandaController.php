<?php

namespace backend\controllers\superadmin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use backend\models\DokumenModel;
use backend\models\LayananModel;
use backend\models\UserModel;
use backend\models\FormulirModel;
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
                                    return Yii::$app->user->can('superadmin');
                                }
                        ],
                    ],
                ],
            ];
    }



    public function actionIndex(){
       $dokumen = DokumenModel::find()->count();
       $layanan = LayananModel::find()->count();
       $user = UserModel::find()->count();
       $formulir = FormulirModel::find()->count();
       return $this->render('index',
            [
                'dokumen' => $dokumen,
                'layanan' => $layanan,
                'user' => $user,
                'formulir' => $formulir,
            ]
        );
    }

}