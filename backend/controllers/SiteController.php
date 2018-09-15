<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\helpers\Url;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo "hello";
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */

    public function actionLogin()
    {

        

        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = "login";
        if (!Yii::$app->user->isGuest) {

            if(Yii::$app->user->identity['user_level'] == 'superadmin')
                return $this->redirect(Url::base().'/$/beranda');
            else if(Yii::$app->user->identity['user_level'] == 'verifikator')
                return $this->redirect(Url::base().'/@/beranda');
        }

        

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {         
            if($model->rememberMe==1)
                $model->rememberMe=0;
            else
                $model->rememberMe=1;
            if($model->login()){
                    if(Yii::$app->user->identity['user_level'] == 'superadmin')
                        return $this->redirect(Url::base().'/$/beranda');
                    else if(Yii::$app->user->identity['user_level'] == 'verifikator')
                        return $this->redirect(Url::base().'/@/beranda');
              }

              

            }
            
     
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }



    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
