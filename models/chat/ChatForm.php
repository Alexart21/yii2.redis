<?php


namespace app\models\chat;

use Yii;
use yii\base\Model;


class ChatForm extends Model
{
    public $name;
    public $text;

    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '',
            'text' => '',
        ];
    }
}