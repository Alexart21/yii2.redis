<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\test\TestModel;
use app\models\test\TestForm;
use yii\web\UploadedFile;
use Yii;
//use app\models\chat\WSchat;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $model = new TestModel();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if ($request->isPost && $model->load($request->post())){
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->validate() && $model->upload()){
                if($request->isPjax){
                    $session->setFlash('success', 'Данные приняты через Pjax');
                    $model = new TestModel();
                }else{
                    $session->setFlash('success', 'Данные приняты стандартно');
                    return $this->refresh();
                }
            }
        }
        return $this->render('index', compact('model'));
    }

    public function actionForm()
    {
        $testForm = new TestForm();
        return $this->render('form', compact('testForm'));
    }
}
