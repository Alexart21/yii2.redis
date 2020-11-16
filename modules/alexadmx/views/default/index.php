<?php
$this->title = 'Административная панель';
?>

<div class="admin-default-index">
    <br>
    <br>
        <a class="btn btn-danger pjax" data-toggle="tooltip" title="очистка кэша" href="/alexadmx/default/cache">очистить кэш</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Установка заголовка LastModified в текущие дату/время" href="/alexadmx/default/last">Last Modified</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Перегенерация файла Sitemap.xml" href="/alexadmx/default/sitemap">Sitemap</a>&nbsp;
    <br>

<!--    --><?php //if ($user === Yii::$app->params['admin_alex']) : ?>
        <h3><a href="/alexadmx/content">Содержимое основных страниц</a> (таблица Content)</h3>
<!--    --><?php //endif; ?>
    <h3><a href="/alexadmx/post">Входящие письма</a></h3>
    <h3><a href="/alexadmx/callback">Заказы обратных звонков</a></h3>
    <?php
    $dirArr = require_once __DIR__ . '/../inc/dirArr.php';
    ?>
    <hr>
    <a class="btn btn-info pjax" data-toggle="tooltip" title="Очистка временных папок(Рекомендуется перед бэкапом)" href="/alexadmx/default/clear">Очистка</a>
    <ol style="float: bottom">
        Очищаются папки:
        <?php
        foreach ($dirArr as $item) :
        ?>
        <li><?= $item ?></li>
        <?php
        endforeach;
        ?>
    </ol>
    <code>Массив с путями к очищаемым папкам: alexadmx/views/inc/dirArr.php</code>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>
