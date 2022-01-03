<?php


namespace app\models\userSettings;


use yii\base\Model;

class TestModel extends Model
{
    public $avatar;

    public function rules()
    {

        return [
//            ['avatar', 'file', 'maxSize' => 1024*1024*5],
            ['avatar', 'file'],
            ['avatar', 'safe'],
            ];
    }
}