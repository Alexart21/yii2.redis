<?php


namespace app\models\test;


use yii\base\Model;
use Yii;

class TestModel extends Model
{
    public $date;
    public $avatar;
    public $test;

    public function rules()
    {
        return [
            ['date', 'required'],
            [['avatar'], 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'skipOnEmpty' => true, 'maxSize' => 1024*1024*5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Выберите дату',
            'test' => 'Test',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if(!empty($this->avatar->size)){
                $originImgPath = 'upload/avatars/' . substr(time(), -4) . strtolower(Yii::$app->security->generateRandomString(12)) . '.' . $this->avatar->extension;
                $this->avatar->saveAs($originImgPath);
            }
            return true;
        } else {
            return false;
        }
    }
}