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
        $id = substr(sha1($ip), 0, 6);

        $msgs = Chat::getMessages();
        $res = '';
        if(!empty($msgs)) {
            foreach ($msgs as $item) {
                $res .= nl2br('<p class="msg-line"><span class="full-name"><span class="ip">' . $id . '_</span><b style="color:' . $item->color . '">' . $item->name . '</b></span><span class="msg-body">' . $item->text . '</span><br><span class="dt">' . $item->created_at . '</span></p>');
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

                $nextMsg = nl2br('<p class="msg-line"><span class="full-name"><span class="ip">' . $id . '_</span><b style="color:' . $color . '">' . $name . '</b></span><span class="msg-body">' . $msg->text . '</span><br><div class="dt">' . $msg->created_at . '</div></p>');
                $res = $nextMsg . $res;
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