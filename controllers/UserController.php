<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\User;
use http\Url;
use yii\base\InvalidValueException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use yii\web\MethodNotAllowedHttpException;


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
            Yii::$app->session->setFlash('success', '<h2 style="color: green">Вы уже залогинены как ' . Yii::$app->user->identity->username);

            return $this->goHome();
        }

        setcookie('rateLimit', Yii::$app->params['rateLimit']); // это чтобы передать в JS количество попыток входа
        $this->layout = 'auth';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findByUsernameOrEmail($model->login_or_email); // проверяем по имени либо email
            //
            if($user) {
                if ($user->isStatusActive()) { // статус 10 для активных
                    $model->login();
                    if (User::isUserAdmin(Yii::$app->user->identity->username)) { // для админа
                        return $this->redirect('/alexadmx');
                    }
                    return $this->goBack();
                }elseif ($user->isStatusDeleted()){
                    throw new MethodNotAllowedHttpException('Такой пользователь удален. Вы можете связаться с администратором сайта.');
                }else{
                    throw new MethodNotAllowedHttpException('Такой пользователь не прошел подтверждение регистрации.Воспользуйтесь ссылкой отправленной Вам на email или свяжитесь с администратором.');
                }
            }
            //
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

            $user->status = User::STATUS_ACTIVE; // метим в базе как прошедшего подтверждение регистрации
            $user->register_token = null;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Вы успешно прошли регистрацию! Введите данные для входа.');
                return $this->redirect('/login');
            }else{
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
                return $this->redirect('/signup');
            }

                /* Вариант с автоматическим входом */
               /* Yii::$app->getUser()->login($user, Yii::$app->params['rememberMeSec']); // запоминаем по умолчанию
                return $this->goHome();*/
        }
        //
        $this->layout = 'auth';
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->signupRequest()) { // занесли в базу и отправили пимьмо заявителю
                Yii::$app->session->setFlash('success', 'Перейдите по ссылке, высланной Вам на E-mail для подтверждения регистрации');
                return $this->redirect('/');
            }else{
                Yii::$app->session->setFlash('error', 'Во время выполнения запроса произошла ошибка!');
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

    /* Запрос на сброс пароля */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'auth';
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->email == Yii::$app->params['adminEmail']){
                throw new MethodNotAllowedHttpException('Вы не можете изменить пароль администратора таким способом !!!');
            }

            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Пройдите по ссылке, высланной Вам на E-mail для сброса пароля');
                return $this->redirect('/');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.Повторите попытку или свяжитесь с администратором.');
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
    /* Сюда попадаем только по ссылке высланной на email*/
    public function actionResetPassword($token)
    {
        /* Вся валидация токена в конструкторе модели ResetPasswordForm */
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
                Yii::$app->session->setFlash('error', 'Во время выполнения запроса произошла ошибка!');
                return $this->refresh();
            }
        }

        $this->layout = 'auth';

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);
    }
}