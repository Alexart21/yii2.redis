<?php

namespace app\controllers;

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
//        die('here');
        $model = new TestModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            var_dump($_FILES['TestModel']['tmp_name']['drag_img']);die;


            $basePath = Yii::getAlias('@app/web') . '/upload/test/';
            // Очищаем папку от предидущих файлов
            $arr = FileHelper::findFiles($basePath, ['only' => ['*.png'], 'recursive' => true]);
            if(!empty($arr)) {
                foreach ($arr as $file) {
                    if (file_exists($file)) {
                        unlink(FileHelper::normalizePath($file));
                    }
                }
            }
            // генерируем имя файла
            $imgName = substr(time(), -4) . strtolower(Yii::$app->security->generateRandomString(12)) . '.' . 'png';

            $drag_img_path = FileHelper::normalizePath($basePath . $imgName);
            $bg_path = FileHelper::normalizePath(  $basePath . 'bg_' . $imgName);
            if (!move_uploaded_file($_FILES['TestModel']['tmp_name']['drag_img'], $drag_img_path)) {
                throw new BadRequestHttpException('Ошибка при загрузке файла');
            }
            if (!move_uploaded_file($_FILES['TestModel']['tmp_name']['background_img'], $bg_path)) {
                throw new BadRequestHttpException('Ошибка при загрузке файла');
            }
            $img_src = '/upload/test/' . $imgName;
            $bg_src = '/upload/test/' . 'bg_' . $imgName;

        }
        return $this->render('index', compact('model', 'img_src', 'bg_src'));
    }


}
