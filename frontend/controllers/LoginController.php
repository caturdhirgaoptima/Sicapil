<?php

namespace frontend\controllers;

class LoginController extends \yii\web\Controller
{
    public $layout = 'sicapillayout';
    public function actionIndex()
    {
        $this->view->params['active'] = 'login';
        return $this->render('index');
    }

}
