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
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже существует.Введите другой'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
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

    public function sendEmail($user)
    {
        if (!$user) {
            return false;
        }

            $link = Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'id' =>  $user->id, 'token' => $user->register_token]);
            $body = 'Для подтверждения регистрации перенйдите по ссылке ' . Html::a(Html::encode($link), $link);
            $body .= '<br>Ссылка действительна в течении ' . Yii::$app->params['user.registerTokenExpire'] / 60 / 24 . 'часов';

        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
            ->setHtmlBody($body)
            ->send();
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 1;
        $user->register_token = time() . '_' . Yii::$app->security->generateRandomString(30);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

    /* Заносим в базу как юзера с неподтвержденной регистрацией */
    public function signupRequest()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 1;
        $user->register_token = time() . '_' . Yii::$app->security->generateRandomString(30);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $save = $user->save();
        return $save && self::sendEmail($user);
    }

}