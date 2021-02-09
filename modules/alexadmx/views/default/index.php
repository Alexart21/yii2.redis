<?php
$this->title = 'Административная панель';
?>

<div class="admin-default-index">
    <br>
    <br>
        <a class="btn btn-warning pjax" data-toggle="tooltip" title="очистка кэша" href="/alexadmx/default/cache">очистить кэш</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Установка заголовка LastModified в текущие дату/время" href="/alexadmx/default/last">Last Modified</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Перегенерация файла Sitemap.xml" href="/alexadmx/default/sitemap">Sitemap</a>&nbsp;
    <br>
<!--    --><?php //if ($user === Yii::$app->params['admin_alex']) : ?>
        <h3><a href="/alexadmx/content">Содержимое основных страниц</a> (таблица Content)</h3>
<!--    --><?php //endif; ?>
    <h3><a href="/alexadmx/post">Входящие письма</a></h3>
    <h3><a href="/alexadmx/callback">Заказы обратных звонков</a></h3>
    <h3><a href="/alexadmx/user">Все пользователи</a></h3>
    <br>
    <?php
    $dirArr = require_once __DIR__ . '/../inc/dirArr.php';
    ?>
    <hr>
    <a class="btn btn-primary" href="/alexadmx/default/phpinfo">PHPINFO</a>
    <a class="btn btn-warning pjax" data-toggle="tooltip" title="Очистка временных папок(Рекомендуется перед бэкапом)" href="/alexadmx/default/clear">Очистка</a>
</div>
<?php
$d = dirname(__DIR__, 1);
$d = str_replace('\\', '/', $d);
?>
    <code>Массив с путями к очищаемым папкам: <?= $d ?>/inc/dirArr.php</code>
</div>
<hr>
<h3><a href="/alexadmx/chat">Чат-сохраненные</a></h3>
<a href="/alexadmx/default/chat-clear" class="btn btn-warning pjax">Очистить чат</a>
<hr>
<h3><a href="/alexadmx/db">БД</a></h3>
