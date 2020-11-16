<?php


namespace app\models\test;


use yii\base\Model;

class TestModel extends Model
{
    public $date;
    public $audioFile;

    public function rules()
    {
        return [
            ['date', 'required'],
            [['audioFile'], 'file',  'skipOnEmpty' => false,  'extensions' => ['mp3', 'ogg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Выберите дату',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->audioFile->saveAs('upload/' . $this->audioFile->baseName . '.' . $this->audioFile->extension);
            return true;
        } else {
            return false;
        }
    }
}