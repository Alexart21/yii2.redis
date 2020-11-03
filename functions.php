<?php

function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
 * фильтрация GET или POST данных
 * @param string $str
 * @return string
 */
function clr_get($str)
{
    $str = trim(strip_tags($str));
    $arr = [
        "delete",
        "update",
        "select",
        "insert",
        "drop",
        "--",
        "/*",
        "*/",
        "./",
        ";"
    ];
    $str = str_ireplace($arr, "", $str);
    return $str;
}

function mb_ucfirst($text)
{
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function hello()
{
    $H = (int)date('H');
    if ($H >= 5 && $H <= 9) {
        $msg = 'Доброе утро';
    } elseif ($H > 9 && $H <= 17) {
        $msg = 'Добрый день';
    } elseif ($H > 17 && $H < 22) {
        $msg = 'Добрый вечер';
    } else {
        $msg = 'Доброго времени суток';
    }

    return $msg;
}