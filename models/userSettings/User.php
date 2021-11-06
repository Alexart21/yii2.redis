<?php

namespace app\models\userSettings;

use app\models\Auth;
use Yii;
//var_dump(Yii::$app->user->identity->getId());
/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $old_username
 * @property string $email
 * @property string $old_email
 * @property string $avatar_path
 * @property int $role
 * @property string $password_hash
 * @property string $auth_key
 * @property string $register_token
 * @property string $email_reset_token
 * @property string $new_email_request
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Auth[] $auths
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $avatar;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'trim'],
            [['username'], 'string', 'max' => 100],
            // имя проверяем на уникальность в базе кроме текукущего (имя не изменили)
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое', 'when' => function($model) {
            return $model->username != Yii::$app->user->identity->username;
            }],
//            [['avatar'], 'file', 'skipOnEmpty' => true, 'maxSize' => 1024*1024*5, 'extensions' => ['jpeg', 'jpg', 'png', 'tiff', 'tif', 'gif'],],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'maxSize' => 1024*1024*5],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя(можно изменить)',
            'email' => 'Email',
            'avatar' => 'Загрузить/изменить аватар',
        ];
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /* Устанавливаем хеш пароля */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /* Проверка на админа */
    public static function isAdmin($username)
    {
        return static::findOne(['username' => $username, 'role' => \app\models\User::ROLE_ADMIN, 'id' => \app\models\User::ADMIN_ID]);
    }
}
