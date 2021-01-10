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
//    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            [['username', 'email', 'password', 'password_repeat'], 'trim'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое'],
            ['username', 'string', 'length' => [3, 100]],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже существует.Введите другой'],
            ['password', 'string', 'length' => [6, 100]],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],
            //reCaptcha v2
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6LftVL4ZAAAAAOY8dZHmrKkRnX1Di43yH0DIq34Z', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/

            //reCaptcha v3
            /* [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                 'secret' => '6LfNdr4ZAAAAAA-JNIMCWXlx_eeYv-JxJzJpdPdz', // unnecessary if reСaptcha is already configured
                 'threshold' => 0.5,
                 'action' => 'signup',
             ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'email',
            'password' => 'пароль',
            'password_repeat' => 'пароль еще раз',
//            'reCaptcha' => '',
        ];
    }

    public function sendEmail($user, $model)
    {
        if (!$user) {
            return false;
        }

        return Yii::$app->mailer->compose(
            ['html' => 'signUp-html'],
            [
                'user' => $user,
                'password' => $model->password,
            ]
        )->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
            ->send();
    }


    /* Заносим в базу как юзера с неподтвержденной регистрацией и оправляем письмо */
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