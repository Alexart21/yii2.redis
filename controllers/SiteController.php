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
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
//use yii\web\View;

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
        if ($request->isAjax && $request->isPost){
            if($indexForm->load($request->post()) && $indexForm->validate()){
                $success = $indexForm->mailSend(); // отправка email

                $msg = new Post();
                $res = $msg->dbSave($indexForm); // звпись в БД

                return $this->renderAjax('mail_ok', compact('success', 'res'));
            }
        }
        /* AJAX вызов страницы (по клику в меню)*/
        if($request->isAjax && $request->isGet){
            return $this->renderAjax('index', compact('data', 'indexForm'));
        }
        /* обычный запрос */
        return $this->render('index', ['data' => $data, 'indexForm' => $indexForm]);
    }

    public function actionSozdanie() {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('sozdanie', compact('data'));
        }
        /* обычный запрос */
        return $this->render('sozdanie', compact('data'));
    }

    public function actionProdvijenie() {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('prodvijenie', compact('data'));
        }
        /* обычный запрос */
        return $this->render('prodvijenie', compact('data'));
    }

    public function actionParsing() {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('parsing', compact('data'));
        }
        /* обычный запрос */
        return $this->render('parsing', compact('data'));
    }

    public function actionPortfolio() {
        $model = new Content();
        $data = $model->getContent();
        /* AJAX запрос */
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('portfolio', compact('data'));
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
        setcookie('rateLimit', Yii::$app->params['rateLimit']); // это чтобы передать в JS количество попыток входа
        $this->layout = 'auth';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
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
}
