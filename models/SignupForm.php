<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            [['username', 'email', 'password', 'password_repeat'], 'trim'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое'],
            ['username', 'string', 'min' => 3, 'max' => 100],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже существует.Введите другой'],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'email',
            'password' => 'пароль',
            'password_repeat' => 'пароль еще раз',
        ];
    }

    public function sendEmail($user, $model)
    {
        if (!$user) {
            return false;
        }

            $link = Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'id' =>  $user->id, 'token' => $user->register_token]);
            $body =  'Вы зарегистрировались на сайте '. Yii::$app->name .' под именем <b style="font-size: 120%">' . $user->username . '</b>. Ваш пароль: <b style="font-size: 120%">' . $model->password . '</b><br> Для подтверждения регистрации перенйдите по ссылке ' . Html::a(Html::encode($link), $link, ['target' => '_blank']);
            $body .= '<br>Ссылка действительна в течении ' . Yii::$app->params['user.registerTokenExpire'] /3600 . 'часа';

        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
            ->setHtmlBody($body)
            ->send();
    }


    /* Заносим в базу как юзера с неподтвержденной регистрацией */
    public function signupRequest()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 1;
        $user->register_token = Yii::$app->security->generateRandomString(30) . '_' . time();;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $save = $user->save();
        return $save && self::sendEmail($user, $this);
    }

    public static function isValidToken($token)
    {
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.registerTokenExpire'];
        return $timestamp + $expire >= time();
    }

}