<?php
$this->title = 'Административная панель';
?>

<div class="admin-default-index">
    <br>
    <br>
        <a class="btn btn-danger pjax" href="/alexadmx/default/cache">очистить кэш</a>&nbsp;
    <a class="btn btn-success pjax" href="/alexadmx/default/last">Last Modified</a>&nbsp;
    <a class="btn btn-success pjax" href="/alexadmx/default/sitemap">Sitemap</a>&nbsp;
    (<b>Очиска кэша/Установка заголовка Last Modified в текущее время/Генерация Sitemap.xml</b>)
    <br>

<!--    --><?php //if ($user === Yii::$app->params['admin_alex']) : ?>
        <h3><a href="/alexadmx/content">Содержимое основных страниц</a> (таблица Content)</h3>
<!--    --><?php //endif; ?>
    <h3><a href="/alexadmx/post">Входящие письма</a></h3>
    <h3><a href="/alexadmx/callback">Заказы обратных звонков</a></h3>

    <?php
        require_once __DIR__ . '/../inc/dirArr.php';
    ?>
    <hr>
    <a class="btn btn-info pjax" href="/alexadmx/default/clear">Очистка</a> Очистка временных папок(Рекомендуется перед бэкапом)
    <ol style="float: bottom">
        Очищаются папки:
        <?php
        foreach ($dirArr as $item){
            echo '<li>' . $item . '</li>';
        }
        ?>
    </ol>
    <code>Массив с путями к очищаемым папкам: alexadmx/views/inc/dirArr.php</code>
</div>
