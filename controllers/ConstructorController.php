<?php


namespace app\controllers;

use yii\helpers\FileHelper;
use yii\web\Controller;
use Yii;

class ConstructorController extends Controller
{
    public $layout = 'constructor';

    public function actionIndex()
    {
    	/*echo 'ConstructorController.php';
    	echo "<br>";
    	echo 'line ' . __LINE__;
    	echo "<br>";
    	echo "stopped";
    	die;*/
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            if (!empty($_FILES["screen"]["size"])) { // пришла картинка (использовали на клиенте JS fetch() ())
                if ($_FILES["avatar"]["size"] > Yii::$app->params['max_screenshot_size'] * 1024 * 1024) { // картинка больше чем позволено
                    Yii::$app->response->statusCode = 413; // 'Length Required'
                    return;
                }
                //
                if (!exif_imagetype($_FILES["screen"]["tmp_name"])) {
                    Yii::$app->response->statusCode = 415; // 'Unsupported Media Type'
                    return;
//                    throw new BadRequestHttpException('Не распознан файл изображения');
                }
                $imgName = substr(time(), -4) . strtolower(Yii::$app->security->generateRandomString(12)) . '.' . 'png';
                $basePath = Yii::getAlias('@app/web') . '/upload/screenshots/';
                if (!file_exists($basePath)) {
                    if (!FileHelper::createDirectory($basePath)) {
//                        Yii::$app->response->statusCode = 400;
//                        return;
                        die('<h1 style="color:red">Непредвиденная ошибка</h1>' . __FILE__ . '<br>' . __LINE__);
                    }
                }
                $imgPath = FileHelper::normalizePath($basePath . $imgName);
                if (!move_uploaded_file($_FILES["screen"]["tmp_name"], $imgPath)) {
                    Yii::$app->response->statusCode = 400;
                    return;
//                    throw new BadRequestHttpException('Ошибка при загрузке файла');
                }

//                die('here-screen');
            }
        }
        return $this->render('index');
    }

    public function actionTest()
    {
        return $this->render('test');
    }

}