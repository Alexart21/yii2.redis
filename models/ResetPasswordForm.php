<?php

namespace app\models;

use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    public $password_repeat;
//    public $reCaptcha;

    /**
     * @var \app\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
//        die('dsds');
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
//        var_dump(User::findByPasswordResetToken($token));
//        var_dump($token);
//        die;
        $this->_user = User::findByPasswordResetToken($token);

//        var_dump($this->_user);die;

        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token...');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'trim'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],
            //reCaptcha v2
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6LftVL4ZAAAAAOY8dZHmrKkRnX1Di43yH0DIq34Z', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/

            //reCaptcha v3
            /* [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                 'secret' => '6LfNdr4ZAAAAAA-JNIMCWXlx_eeYv-JxJzJpdPdz', // unnecessary if reСaptcha is already configured
                 'threshold' => 0.5,
                 'action' => 'reset-password',
             ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'новый пароль',
            'password_repeat' => 'повторите пароль',
//            'reCaptcha' => '',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}