<?php

namespace backend\controllers\superadmin;

use Yii;
use backend\models\UserModel;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\helpers\ArrayHelper;
use backend\models\LayananModel;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use backend\models\AuthAssignmentModel;
/**
 * UserController implements the CRUD actions for UserModel model.
 */
class UserController extends Controller
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

    /**
     * Lists all UserModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->can('view-user'))
             throw new ForbiddenHttpException;
             
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('create-user'))
             throw new ForbiddenHttpException;
        
        $layanan = LayananModel::find()->all();
        $listData=ArrayHelper::map($layanan,'id','nama_layanan');
        $model = new UserModel();
        if ($model->load(Yii::$app->request->post())) {
            $date = date("Ymdhis");
            $model->user_id = uniqid($date);
            $model->user_authKey = User::generateAuthKey();
            $model->user_password = User::setPassword($model->user_password);

            $model2 = new AuthAssignmentModel();
            $model2->item_name = $model->user_level;
            $model2->user_id = $model->user_id;

            if($model->save() and $model2->save()){
                 Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Ditambah",
                    'title' => 'Tambah User',
                ]);  
           
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('create', [
            'layanan' => $listData,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if(!Yii::$app->user->can('update-user'))
             throw new ForbiddenHttpException;

        $layanan = LayananModel::find()->all();
        $listData=ArrayHelper::map($layanan,'id','nama_layanan');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_authKey = User::generateAuthKey();
            $model->user_password = User::setPassword($model->user_password);
            if($model->save()){
                 Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Diubah",
                    'title' => 'Update User',
                ]); 
             }
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'layanan' => $listData,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if(!Yii::$app->user->can('delete-user'))
             throw new ForbiddenHttpException;

        if($this->findModel($id)->delete()){
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Dihapus",
                    'title' => 'Hapus User',
                ]);  
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
