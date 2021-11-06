<?php


namespace app\models\userSettings;


//use yii\base\Model;
use app\models\LoginForm;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $avatar_path
 * @property int $role
 * @property string $password_hash
 * @property string $auth_key
 * @property string $register_token
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Auth[] $auths
 */
class PassForm extends ActiveRecord
{
    public $password;
    public $new_password;
    public $new_password_repeat;

    public function rules()
    {
        return [
            [['password', 'new_password', 'new_password_repeat'], 'trim'],
            ['password', 'string', 'length' => [6, 100]],
            ['password', 'validatePassword'],
            ['new_password', 'string', 'length' => [6, 100]],
            ['new_password_repeat', 'compare', 'compareAttribute'=>'new_password', 'message'=>"Пароли не совпадают !" ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Ваш пароль',
            'new_password' => 'Новй пароль',
            'new_password_repeat' => 'Повторите новый пароль',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(\Yii::$app->user->identity->getId());
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }
}