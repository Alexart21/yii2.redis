<?php


namespace app\controllers;


use app\models\chat\Chat;
use app\models\chat\ChatForm;
use yii\web\Controller;
use Yii;

class ChatController extends Controller
{
    public $layout = 'test';


    public function actionIndex()
    {
        $session = Yii::$app->session;

        $name = $session->get('user_name');
        $color = $session->get('user_color');
        /*if($name && $color){
            setcookie('user_color', $color);
            setcookie('user_name', $name);
        }*/
        $ip = Yii::$app->request->userIP;

        $msgs = Chat::getMessages();
        $res = '';
        if(!empty($msgs)) {
            foreach ($msgs as $item) {
                $res .= nl2br('<span class="msg-line"><span class="ip">' . $ip . '_</span><b style="color:' . $item->color . '">' . $item->name . '</b> : ' . $item->text . '</span><br>');
            }
        }else{
            $res = '<span class="msg-line"><b>ADMIN</b> : Можете начать чат!</span><br>';
        }
        $msg = new Chat();
        $chatForm = new ChatForm();
        $request = Yii::$app->request;

        if ($request->isAjax){
            if($chatForm->load($request->post()) && $chatForm->validate()){
                if((!$name  || !$color) || ($name != $chatForm->name)){ // пусто или пользователь сменил имя
                    $name = $chatForm->name;
                    $color = self::rndColor();
                    $session->set('user_name', $name);
                    $session->set('user_color', $color);
                    setcookie('user_color', $color);
                    setcookie('user_name', $name);
                }

                $msg->name = $name;
                $msg->text = $chatForm->text;
                $msg->ip = $ip;
                $msg->color = $color;
                $msg->save();

                $nextMsg = nl2br('<span class="msg-line"><span class="ip">' . $ip . '_</span><b style="color:' . $color . '">' . $name . '</b> : ' . $msg->text . '</span><br>');
                $res .= $nextMsg ;
                die($res);
            }else{ // таймер setInterval сработал
               die($res);
            }

        }

        return $this->render('index', compact('chatForm', 'res', 'name'));
    }

    public static function rndColor()
    {
        return '#' . dechex(rand(0,10000000));;
    }
}