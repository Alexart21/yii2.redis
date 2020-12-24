<?php

namespace app\controllers;

use app\models\IndexForm;
//use app\models\User;
//use yii\helpers\Html;
use app\models\Content;
use app\models\LoginForm;
use app\models\CallForm;
use app\models\Callback;
use app\models\Post;
use app\models\User;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\web\BadRequestHttpException;
use yii\base\InvalidValueException;

class SiteController extends Controller
{
    /*dist function actionError()
{
    $errorCode = Yii::$app->errorHandler->exception->statusCode;
    $errorMsg = Yii::$app->errorHandler->exception->getMessage();
        if ($errorCode == 404) {
            $this->layout = 'error';
           return $this->render('_404', ['errorMsg' => $errorMsg]);
        }
}*/
    /**
     * @inheritdoc
     */
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
                'only' => ['login'],
                // The maximum number of allowed requests
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
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
            $user = User::findOne(['email' => $model->email]);
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
    public function actionSignup($token = null, $id = null)
    {
        if($token && $id){ // пришли по ссылке для подтверждения регистрации
            $id = (int)$id;
            $token = Html::encode($token);
            $user = User::findOne(['id' => $id, 'register_token' => Html::encode($token)]);
            if($user){
                $user->status = 10;
                $user->save();
                Yii::$app->getUser()->login($user);
                return $this->goHome();
            }
        }

        $this->layout = 'auth';
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signupRequest()) {
                Yii::$app->session->setFlash('success', 'На указанный email выслана ссылка для подтверждения регистрации');
            }else{
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }
            return $this->refresh();
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
                Yii::$app->session->setFlash('success', 'На указанный email выслана ссылка для сброса пароля');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }
            return $this->refresh();
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
    public function actionResetPassword($token)
    {
        $this->layout = 'auth';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            die('HERE');
            if ($model->resetPassword()) {
                Yii::$app->session->setFlash('success', 'Новый пароль установлен');
                return $this->redirect('/login');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка !');
                return $this->refresh();
            }

        }

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);


    }

    public function registerComplete($token)
    {
        die($token);
    }
}
