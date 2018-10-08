<?php

namespace backend\controllers\superadmin;

use Yii;
use backend\models\AuthAssignmentModel;
use backend\models\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UserModel;
use backend\models\AuthItemModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignmentModel model.
 */
class AuthAssignmentController extends Controller
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

    public function actionAkses(){
      

        $id= Yii::$app->request->get('id');
        $user = UserModel::find()->where(['user_id' => $id])->one();
        $akses = AuthItemModel::find()->all();
        $listAkses = ArrayHelper::map($akses, 'name', 'description');
        $value = AuthItemModel::find()->joinWith('authAssignments', 'authItem.name=authAssignments.item_name')->where(['user_id' => $id])->all();
        $data = [];
        foreach($value as $val)
            $data[] = $val->name;

        if(Yii::$app->request->post()){
            $user = Yii::$app->request->post('username');
            $akses = Yii::$app->request->post('akses');
            AuthAssignmentModel::deleteAll("user_id='$user'");

            foreach($akses as $a){
                $model = new AuthAssignmentModel();
                $model->user_id = $user;
                $model->item_name = $a;
                $model->save();
            }
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Berhail Memperbarui Hak Akses User",
                    'title' => 'Hak Akses',
                ]);  

            return $this->redirect(['/$/master-user/user']);
        }


        return $this->render('akses', [
            'user' => $user,
            'akses' => $listAkses,
            'value' => $data,
        ]);
    }
}
