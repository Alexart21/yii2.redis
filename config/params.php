<?php
return [
    'siteUrl' =>'l917678y.beget.tech',
    'company' => 'Alex-art21',
    'email' => 'mail@site.ru',
    'tel1' => '+7(987) 668-04-84',
    'tel1_min' => '+79876680484',
    'tel1_i' => '79876680484',
    'admin' => 'admin_alex',
    'rateLimit' => 5, // попыток входа в минуту. В scripts.js Тоже можно эту цифру (строка )
    /*
        1728000 => 20 суток
        2592000 => 30 суток
        15552000 => 180 суток
    */
    'rememberMeSec' => 2592000, // запомнить в секундах
    'rememberMeDay' => 30, // то же в сутках(показать пользователю)
];
