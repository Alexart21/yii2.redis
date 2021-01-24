<?php

namespace app\controllers;

use app\models\Auth;
use app\models\IndexForm;
use app\models\Content;
use app\models\CallForm;
use app\models\Callback;
use app\models\Post;
use app\models\User;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $auth Auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // авторизация
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // регистрация
                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Пользователь с такой электронной почтой как в {client} уже существует, но с ним не связан. Для начала войдите на сайт использую электронную почту, для того, что бы связать её.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['login'],
                        'email' => $attributes['email'],
                        'password_hash' => $password,
                        'status' => 10,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // Пользователь уже зарегистрирован
            if (!$auth) { // добавляем внешний сервис аутентификации
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Content();
        $indexForm = new IndexForm();
        $data = $model->getContent();

        $request = Yii::$app->request;
        /* Отправка сообщения и запись в БД */
        if ($request->isAjax && $request->isPost) {
            if ($indexForm->load($request->post()) && $indexForm->validate()) {
                $success = $indexForm->mailSend(); // отправка email

                $msg = new Post();
                $res = $msg->dbSave($indexForm); // звпись в БД

                return $this->renderPartial('mail_ok', compact('success', 'res'));
            }
        }
        /* AJAX вызов страницы (по клику в меню)*/
        if ($request->isAjax && $request->isGet) {
            return $this->renderPartial('index', compact('data', 'indexForm'));
        }
        /* обычный запрос */
        return $this->render('index', ['data' => $data, 'indexForm' => $indexForm]);
    }

    public function actionSozdanie()
    {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('sozdanie', compact('data'));
        }
        /* обычный запрос */
        return $this->render('sozdanie', compact('data'));
    }

    public function actionProdvijenie()
    {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('prodvijenie', compact('data'));
        }
        /* обычный запрос */
        return $this->render('prodvijenie', compact('data'));
    }

    public function actionParsing()
    {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('parsing', compact('data'));
        }
        /* обычный запрос */
        return $this->render('parsing', compact('data'));
    }

    public function actionPortfolio()
    {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('portfolio', compact('data'));
        }
        /* обычный запрос */
        return $this->render('portfolio', compact('data'));
    }


    public function actionPolitic()
    {
        return $this->renderFile(__DIR__ . '/../views/site/politic.php');
    }

    /* Виджет обратного звонка */
    public function actionCall()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $formModel = new CallForm();

            if ($formModel->load($request->post()) && $formModel->validate()) { // Форма отправлен
                // Отправка email и запись в БД
                $success = $formModel->callSend();
                $call = new Callback();
                $res = $call->dbSend($formModel);
                // выводим модальное окно об успехе/ошибке
                return $this->renderAjax('call_ok', compact('success', 'res'));
            }
            // модальное окно с формой
            return $this->renderAjax('call', compact('formModel'));
        }
    }

}
