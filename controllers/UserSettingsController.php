<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\userSettings\PassForm;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use Yii;
use app\models\userSettings\User;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UploadedFile;
use app\models\userSettings\EmailForm;
use yii\widgets\ActiveForm;
use yii\web\Response;

class UserSettingsController extends \yii\web\Controller
{
    public $layout = 'auth';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // для авторизованных
                    ]
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            // разлогиниваем
            Yii::$app->user->logout();
            die('<h1>Раз уж ты админ то все делай ручками !!!</h1>');
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->identity->getId());
        if(!$model){
            throw new MethodNotAllowedHttpException('Нет такого пользователя.Как ты сюда попал(а)?!');
        }
        // AJAX валидация(поле username)
        if (Yii::$app->request->isAjax) {
            if($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // пользователь изменил имя
            if ($model->username != Yii::$app->user->identity->username){
                if(empty($model->old_username)){
                    $old_username = [];
                }else{
                    $old_username = unserialize($model->old_username);
                }
                array_push($old_username, Yii::$app->user->identity->username);
                $model->old_username = serialize($old_username);
            }
            //
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if (!empty($model->avatar->size)) { // для загрузивших аватар
                $imgName = substr(time(), -4) . strtolower(Yii::$app->security->generateRandomString(12)) . '.' . $model->avatar->extension;
                $usrId = $model->id;
                $basePath = Yii::getAlias('@app/web') . '/upload/users/';
                $imgDir = $basePath . 'usr' . $usrId . '/img';
                if (!FileHelper::createDirectory($imgDir)){
                    die('<h1>Непредвиденная ошибка</h1>' . __FILE__ . '<br>' . __LINE__);
                }
                $imgPath = FileHelper::normalizePath($imgDir . '/' . $imgName);
                if(!$model->avatar->saveAs($imgPath)){
                    die('<h1>Не Удалось загрузить файл</h1>');
                }
                $model->avatar_path = $imgName;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Успешно!');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }
        }
        return $this->render('index', compact('model'));
    }

    // закрытие аккаунта
    public function actionClose()
    {
        $model = User::findOne(Yii::$app->user->identity->getId());
        if(!$model){
            throw new MethodNotAllowedHttpException('Нет такого пользователя.Как ты сюда попал(а)?!');
        }
        // помечаем в базе как удаленного(неактивного)
        $model->status = 0;
        if (!$model->save()) {
            die('<h1 style="color: red">Произошла ошибка</h1>');
        }
        // разлогиниваем
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // изменение email
    public function actionEmail($id = null, $token = null)
    {
        if ($id && $token) { // пришли по ссылке для подтверждения смены email
            $id = (int)$id;
            $token = Html::encode($token);
            if (!SignupForm::isValidToken($token)) {
                throw new BadRequestHttpException('Недействительный токен');
            }

            $user = User::findOne(['id' => $id, 'email_reset_token' => $token]);
            if (!$user) {
                throw new BadRequestHttpException('Не найден пользователь, попробуйте повторить попытку или свяжитесь с администратором');
            }
            ///
            if(empty($user->old_email)){
                $old_email = [];
            }else{
                $old_email = unserialize($user->old_email);
            }
            array_push($old_email, Yii::$app->user->identity->email);
            $user->old_email = serialize($old_email);
            ///
            $user->email = $user->new_email_request;
            $user->email_reset_token = null;
            $user->new_email_request = null;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Вы успешно сменили Email.');
                 return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка. Повторите попытку или свяжитесь с администратором.');
                return $this->goHome();
            }
        }
////////////////////////
        $emailFormModel = new EmailForm();
        // AJAX валидация
        if (Yii::$app->request->isAjax) {
            if($emailFormModel->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($emailFormModel);
            }
        }

        if ($emailFormModel->load(Yii::$app->request->post()) && $emailFormModel->validate()) {
            $user = User::findOne(Yii::$app->user->identity->getId());
            $user->email_reset_token = Yii::$app->security->generateRandomString(30) . '_' . time();
            $user->new_email_request = $emailFormModel->email;
            $save = $user->save();
            $sendEmail = $emailFormModel->sendEmail($user);
            $result = $save && $sendEmail;

            if ($result) {
                Yii::$app->session->setFlash('success', 'Для завершения пройдите по ссылке высланной Вам на новый Email. Ссылка валидна в течении ' . Yii::$app->params['user.registerTokenExpire'] /3600 . ' часа');
                return $this->redirect('/');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка. Повторите попытку или свяжитесь с администратором');
                return $this->redirect('/');
            }
        }

        return $this->render('email', compact('emailFormModel'));
    }

    public function actionPass()
    {
        $passFormModel = new PassForm();
        if ($passFormModel->load(Yii::$app->request->post()) && $passFormModel->validate()) {
            $user = User::findOne(Yii::$app->user->identity->getId());
            if(!$user){
                throw new MethodNotAllowedHttpException('Нет такого пользователя.Как ты сюда попал(а)?!');
            }
            $user->setPassword($passFormModel->new_password);
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Ваш пароль успешно изменен.');
                Yii::$app->user->logout(false); // не удаляем сесии
                return $this->redirect('/user/login');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('pass', compact('passFormModel'));
    }

    /* Удаление аватара */
    public function actionDeleteAvatar()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());
        if(!$user){
            throw new MethodNotAllowedHttpException('Нет такого пользователя.Как ты сюда попал(а)?!');
        }
        $user->avatar_path = null;
        $user->save();
        return $this->redirect('index');
    }
}
