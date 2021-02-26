<?php
namespace app\controllers;

use yii\web\Controller;


class WschatController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        return $this->render('index');
    }
}