<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\test\TestModel;
use yii\web\UploadedFile;
use Yii;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $model = new TestModel();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if ($request->isPost && $model->load($request->post())){
            $model->audioFile = UploadedFile::getInstance($model, 'audioFile');
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
}
