<?php

namespace frontend\controllers;
use Yii;

class BerandaController extends \yii\web\Controller
{
    public $layout = 'sicapillayout';
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session['logged_in'] = true;
        $this->view->params['active'] = 'beranda';
        return $this->render('index');
    }

}
