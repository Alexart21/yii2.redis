<?php

namespace app\controllers;

use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\web\Controller;
use app\models\test\TestModel;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use Yii;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $this->enableCsrfValidation = false;
        $model = new TestModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }
        return $this->render('index', compact('model'));
    }

    public function actionNew()
    {
        $model = new TestModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }
        return $this->render('new', compact('model'));
    }

    public function actionAlert()
    {
        return $this->render('alert');
    }

    public function actionFaker(){
        return $this->render('faker');
    }

    public function actionAddress()
    {
        $token = "72d8b6890a405a1aaf649d30531852a79418a739";
        $secret = "5c3d8c81b1ec5359d134344831f557c221967f84";
        $dadata = new \Dadata\DadataClient($token, $secret);

        $response = $dadata->clean("address", "урюпинск");
        var_dump($response);
        die;
        return $this->render('address');
    }
    

}
