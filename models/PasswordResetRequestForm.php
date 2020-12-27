<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
//  public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Не найден пользователь с таким email'
            ],
            //reCaptcha v2
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6LftVL4ZAAAAAOY8dZHmrKkRnX1Di43yH0DIq34Z', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/

            //reCaptcha v3
            /* [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                 'secret' => '6LfNdr4ZAAAAAA-JNIMCWXlx_eeYv-JxJzJpdPdz', // unnecessary if reСaptcha is already configured
                 'threshold' => 0.5,
                 'action' => 'request-password-reset',
             ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => '',
//            'reCaptcha' => '',
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);
        $body = 'Вы запрашивали сброс пароля. Перейдите по ссылке ' . Html::a(Html::encode($resetLink), $resetLink, ['target' => '_blank']);
        $body .= '<br>Ссылка действительна в течении ' . Yii::$app->params['user.passwordResetTokenExpire']/60 . 'минут';

        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->setHtmlBody($body)
            ->send();
    }

}