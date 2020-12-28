<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\User;
use yii\base\InvalidValueException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;


class UserController  extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'rateLimiter' => [
                // сторонняя фича. Пишется в кэш.Бд не трогается.
                'class' => \ethercreative\ratelimiter\RateLimiter::className(),
//                'only' => ['login'],
//                'only' => ['login', 'signup', 'requestPasswordReset', 'passwordReset'],
                // The maximum number of all'ow'ed requests
                'rateLimit' => Yii::$app->params['rateLimit'],
                // The time period for the rates to apply to
                'timePeriod' => 60,
                // Separate rate limiting for guests and authenticated users
                // Defaults to true
                // - false: use one set of rates, whether you are authenticated or not
                // - true: use separate ratesfor guests and authenticated users
                'separateRates' => false,
                // Whether to return HTTP headers containing the current rate limiting information
                'enableRateLimitHeaders' => false,
                'errorMessage' => 'Лимит запросов исчерпан. Не более ' . Yii::$app->params['rateLimit'] . ' попыток в минуту',
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        die("user/index");
    }

    /**
     * Login action.
     *
     * @return string
     */

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        setcookie('rateLimit', Yii::$app->params['rateLimit']); // это чтобы передать в JS количество попыток входа
        $this->layout = 'auth';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findByUsernameOrEmail($model->login_or_email); // проверяем по имени либо email
            if($user->status == 10){ // статус 10 для подтвердивших регистрацию
                $model->login();
                if(User::isUserAdmin(Yii::$app->user->identity->username)){ // для админа
                    return $this->redirect('/alexadmx');
                }
                return $this->goBack();
            }elseif($user->status == 1){
                throw new BadRequestHttpException('Пользователь с таким email не прошел подтверждение регистрации.Воспользуйтесь ссылкой отправленной Вам на email');
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /* Регистрация пользователя */
    public function actionSignup($id = null, $token = null)
    {
        if($id && $token){ // пришли по ссылке для подтверждения регистрации

            $id = (int)$id;
            $token = Html::encode($token);
            if(!SignupForm::isValidToken($token)){
                throw new BadRequestHttpException('Недействительный токен');
            }
            $user = User::findOne(['id' => $id, 'register_token' => $token]);
            if(!$user){
                throw new BadRequestHttpException('Не найден пользователь, попробуйте пройти регистрацию повторно');
            }
            if($user){
                $user->status = 10; // метим в базе как прошедшего подтверждение регистрации
                $user->register_token = null;
                $res = $user->save();
                if ($res) {
                    Yii::$app->session->setFlash('success', 'Вы успешно прошли регистрацию! Введите данные для входа.');
                }else{
                    Yii::$app->session->setFlash('error', 'Произошла ошибка.');
                }
                return $this->redirect('/login');

                /* Вариант с автоматическим входом */
               /* Yii::$app->getUser()->login($user, Yii::$app->params['rememberMeSec']); // запоминаем по умолчанию
                return $this->goHome();*/
            }
        }

        $this->layout = 'auth';
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signupRequest()) {
                Yii::$app->session->setFlash('success', 'Перейдите по ссылке, высланной Вам на E-mail для подтверждения регистрации');
                return $this->redirect('/');
            }else{
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
                return $this->refresh();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /* Сброс пароля */

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'auth';
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Пройдите по ссылке, высланной Вам на E-mail для сброса пароля');
                return $this->redirect('/');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
                return $this->refresh();
            }

        }

        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    /* Сюда попадаем только по ссылке */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        }catch(InvalidValueException $e){
            new BadRequestHttpException($e->getMessage());
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $res = $model->resetPassword(); // Имя пользователя сюда возвращается при успехе
            if ($res) {
                Yii::$app->session->setFlash('success', 'Новый пароль установлен для пользователя ' . Html::encode($res));
                return $this->redirect('/login');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка !');
                return $this->refresh();
            }
        }

        $this->layout = 'auth';

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);
    }
}