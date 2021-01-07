<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
//use yii\filters\RateLimitInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property int $role
 * @property string $password_hash
 * @property string $auth_key
 * @property string $register_token
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    const STATUS_DELETED = 0; // помечен удаленным
    const STATUS_REQUEST = 1; // пользователь не прошедший подтверждение регистрации
    const STATUS_ACTIVE = 10; // активный
    const ROLE_USER = 10; // статус пользователя
    const ROLE_ADMIN = 20; // статус админа
    const ADMIN_ID = 1; // админ только один и с таким id

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_REQUEST, self::STATUS_DELETED]],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],

            [['username', 'email'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['register_token', 'password_reset_token'], 'string'],
            [['username'], 'string', 'length' => [3, 100]],
            [['email', 'password_hash', 'auth_key'], 'string', 'max' => 255],
            ['email', 'unique', 'message' => 'Такой email уже существует.'],
            ['username', 'unique', 'message' => 'Такое имя уже существует.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    /*public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }*/

    public static function findByUsernameOrEmail($string)
    {
       /*$sql = 'SELECT * FROM USER WHERE username=:string or email=:string';
       return static::findBySql($sql, [':string' => $string])->one();*/
      return static::find()->Where(['username' => $string])->orWhere(['email' => $string])->one();
    }

    public function isStatusActive(){
        return $this->status == self::STATUS_ACTIVE;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($auth_key)
    {
        return $this->authKey === $auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }



    /* Добавлено для восстановления пароля */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {

        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString(30) . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /* Проверка на админа */
    public static function isUserAdmin($username)
    {
        return (bool)static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN, 'id' => self::ADMIN_ID]);
    }

}
