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
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],

        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '',
            'password_repeat' => ''
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
//        var_dump($this->_user);

        $user = $this->_user;
//        die($this->password);
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}