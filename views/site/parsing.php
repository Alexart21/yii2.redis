<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Last-Modified:' . gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
$this->title = $data['title'];
$this->registerMetaTag(['name' => 'description', 'content' => $data['description']]);
?>

<?php $this->beginBlock('h1'); ?>
Парсинг сайтов
<?php $this->endBlock(); ?>
<script>
    window.document.title = "<?= $data['title'] ?>";
    document.getElementById('top_h').innerText = 'Парсинг сайтов';
</script>
<?php
//echo $data['page_text'];
?>
<img width="250" height="167" class="resp_img" src="/img/main_img/parsing.jpg" alt="парсинг сайтов"
     title="парсинг сайтов">
<article>
    <h2 class="header_shadow">Парсинг сайтов</h2>
    <p>
        <span class="mark">Создали сайт и не знаете чем его наполнить ?</span><br/>
        Подобная проблема совсем не редкость.Где же взять контент?
        Конечно же в интернете.
    </p>
    <p>
        Другая ситуация - Вам необходим постоянный мониторинг сайтов например конкурентов.И в этом случае
        Вам на помощь придут программы парсеры.
    </p>
    <h3 class="header_shadow">Что же такое парсинг сайтов и кому это может понадобится</h3>
    <p>
        Говоря по простому парсинг сайтов это получение любых необходимых структурированных
        данных из сети интернет.Т.е. добывание нужной информации как то статьи,картинки,
        видео или любой другой контент.Конечно все это можно сделать и вручную. <b>Но !</b><br/>
        Если вам нужно найти и скачать несколько фотографий или статей то конечно яндекс с
        гуглом вам в помощь.<br/>
        При больших же объемах информации делать это вручную весьма утомительно.
        Этот процесс можно автоматизировать.Тут Вам на помощь придут программы парсеры.
    </p>
    <p>
        <strong>Достоинства парсинга:</strong>
    <ul>
        <li><span class="l1"></span>
            Программа парсер быстро и и безошибочно отделит служебную и техническую информацию
            от нужной.
        </li>
        <li><span class="l1"></span>
            Парсер легко справляется с большими объемами информации.
        </li>
        <li><span class="l1"></span>
            Минимальное участие человека.Практически весь процесс автоматизирован.
        </li>
    </ul>
    <br/>
    <strong>Недостатки:</strong>
    <br/>
    <p>
        Недостаток пожалуй единственный но достаточно серьезный. Это <b>Копипаст!</b><br/>
        Копипаст первейший враг поисковых машин!<br/>
        Поэтому всегда старайтесь использовать уникальный контент.

    </p>
    <p>
        Стоимость парсинга сайта начинается от <span class="red">1&#8202;500</span><span class="fa fa-ruble-sign"></span>
    </p>
    <p>
        Если Вам нужен парсинг сайта свяжитесь с нами любым удобным для Вас способом.Мы осуществим
        парсинг любых сайтов в том числе и сайтов с авторизацией и соцсетей.<br>
        Полученные данные предоставим в любом удобном для Вас формате(CSV,XLS,или дамп базы данных).
    </p>
</article>

