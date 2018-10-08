<?php

namespace frontend\controllers;

class LacakberkasController extends \yii\web\Controller
{
    public $layout = 'sicapillayout';
    public function actionIndex()
    {
        $this->view->params['active'] = 'lacakberkas';
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->view->params['active'] = 'lacakberkas';
        return $this->render('detailberkas');
    }

}
