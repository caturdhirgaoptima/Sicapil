<?php

namespace backend\controllers\superadmin;

use Yii;
use backend\models\DataFormulirModel;
use backend\models\DataFormulirSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\filters\AccessControl;
/**
 * DataFormulirController implements the CRUD actions for DataFormulirModel model.
 */

class DataFormulirController extends Controller
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
     * Lists all DataFormulirModel models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        if(!Yii::$app->user->can('view-data-formulir'))
             throw new ForbiddenHttpException;

        $session = Yii::$app->session;
        $session->set('id_formulir',$id); 
        $searchModel = new DataFormulirSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataFormulirModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         if(!Yii::$app->user->can('view-data-formulir'))
             throw new ForbiddenHttpException;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataFormulirModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(!Yii::$app->user->can('create-data-formulir'))
             throw new ForbiddenHttpException;

        $session = Yii::$app->session;
        if(!$session->has('id_formulir'))
            return $this->redirect([Url::to("/$/master-formulir/formulir")]);

        $model = new DataFormulirModel();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_formulir = $session->get('id_formulir');
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Ditambah",
                    'title' => 'Tambah Data Formulir',
                ]);  
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataFormulirModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         if(!Yii::$app->user->can('update-data-formulir'))
             throw new ForbiddenHttpException;

        $session = Yii::$app->session;
        if(!$session->has('id_formulir'))
            return $this->redirect([Url::to("/$/master-formulir/formulir")]);

        $model = $this->findModel($id);
        $model->id_formulir = $session->get('id_formulir');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Diubah",
                    'title' => 'Update Data Formulir',
                ]);  
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataFormulirModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         if(!Yii::$app->user->can('delete-data-formulir'))
             throw new ForbiddenHttpException;

         $session = Yii::$app->session;
        if($this->findModel($id)->delete()){
            Yii::$app->getSession()->setFlash('success', [
                    'message' => "Data Berhasil Dihapus",
                    'title' => 'Hapus Data Formulir',
                ]);  
        }

        return $this->redirect([Url::to("/$/master-formulir/formulir/data-formulir/".$session->get('id_formulir'))]);
    }

    /**
     * Finds the DataFormulirModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataFormulirModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataFormulirModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
