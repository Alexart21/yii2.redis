<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=172.17.0.1;dbname=alexart1_mih', // ip из docker inspect <mysql_cont_id>  "Gateway": "172...."
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function($event) {
        $event->sender->createCommand("SET GLOBAL time_zone='Europe/Moscow'")->execute();
    }
];