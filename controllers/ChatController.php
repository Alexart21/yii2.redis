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
        $id = Yii::$app->request->userIP;

        $name = $session->get('chat_name');
        $color = $session->get('chat_color');

        $msgs = Chat::getMessages();
        $res = '';
        if(!empty($msgs)) {
            foreach ($msgs as $item) {
                $res .= nl2br('<span class="msg-line"><b style="color:' . $item->color . '">' . $item->name . '</b> : ' . $item->text . '</span><br>');
            }
        }else{
            $res = nl2br('<span class="msg-line"><b>ADMIN</b> : Можете начать чат!</span><br>');
        }
        $msg = new Chat();
        $chatForm = new ChatForm();
        $request = Yii::$app->request;

        if ($request->isAjax){
            if($chatForm->load($request->post()) && $chatForm->validate()){
                if($name != $id . '_' . $chatForm->name){ // пользователь сменил имя
                    $name = $color = null;
                }
//                var_dump($cookies->get('chat_name'));die;
                if(empty($name) || empty($color)){
                    $name = $id . '_' . $chatForm->name;
                    $color = self::rndColor();

                    $session->set('chat_name', $name);
                    $session->set('chat_color', $color);
                }

                $msg->name = $name;
                $msg->text = $chatForm->text;
                $msg->color = $color;
                $msg->save();

                $nextMsg = nl2br('<span class="msg-line"><b style="color:' . $color . '">' . $name . '</b> : ' . $msg->text . '</span><br>');
                $res .= $nextMsg ;
                die($res);
            }else{ // таймер setInterval сработал
               die($res);
            }

        }

        return $this->render('index', compact('chatForm', 'res', 'name', 'color'));
    }

    public static function rndColor()
    {
        return '#' . dechex(rand(0,10000000));;
    }
}