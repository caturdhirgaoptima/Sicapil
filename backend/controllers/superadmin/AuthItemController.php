<?php

namespace backend\controllers\superadmin;

use Yii;
use backend\models\AuthItemModel;
use backend\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * AuthItemController implements the CRUD actions for AuthItemModel model.
 */
class AuthItemController extends Controller
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
     * Lists all AuthItemModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItemModel model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         if(!Yii::$app->user->can('view-akses'))
             throw new ForbiddenHttpException;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItemModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('create-akses'))
             throw new ForbiddenHttpException;

        $model = new AuthItemModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Ditambah",
                    'title' => 'Tambah Hak Akses',
                ]); 
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItemModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('update-akses'))
             throw new ForbiddenHttpException;

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Diubah",
                    'title' => 'Update Hak Akses',
                ]); 
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItemModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('delete-akses'))
             throw new ForbiddenHttpException;

        if($this->findModel($id)->delete()){
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Dihapus",
                    'title' => 'Hapus Hak Akses',
                ]); 
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItemModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItemModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItemModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
