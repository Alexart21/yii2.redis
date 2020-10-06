<?php

namespace app\controllers;

use yii\web\Controller;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        return $this->render( 'index', [
//            'model' => $model,
        ]);
    }

    public function actionPhpinfo()
    {
        return $this->render('phpinfo');
    }
}
