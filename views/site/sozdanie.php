<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Last-Modified:' . gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));

$title_seo = $data['title_seo'] ? $data['title_seo'] : $data['title']; // в тег title
$title = $data['title']; // в заголовок h1

$this->title = $title_seo;
$desc = $data['description'] ? $data['description'] : '';
$this->registerMetaTag(['name' => 'description', 'content' => $desc]);

// В шаблон в тег h1
$this->beginBlock('h1');
echo $title;
$this->endBlock('h1');
?>
<!-- JS для AJAX переходов по ссылкам -->
<script>
    window.document.title = "<?= $title_seo ?>";
    document.getElementById('top_h').innerText = '<?= $title ?>';
</script>
<figure class="position-relative">
    <img width="250" height="167" class="resp_img no_shadow no_border align-left img-outs1"
         src="/img/main_img/sozdanie.png" alt="создание сайтов" title="создание сайтов">
<span class="fab fa-html5"></span>
<span class="fab fa-css3"></span>
<span class="fab fa-js"></span>
</figure>
<article>
    <h2 class="header_shadow">Создание сайтов для бизнеса и не только</h2>
    <p>
        Интернет — основная медиа среда сегодняшнего времени.<br>
        <strong>Сайт</strong> сегодня — один из приоритетных инструментов для развития бизнеса.
        Большинство предпринимателей стараются завести в сети интернет свою площадку для привлечения новых клиентов
        и развития своей деятельности.
        Иными словами, отсутствие своего сайта у компании ощутимый минус для неё.
        <br>
        Наша группа готова предложить
        Вам услуги по созданию сайтов любой тематики и направленности и для любого региона. Только
        сделанный профессионально информационно насыщенный сайт сможет дать Вам поток потенциальных клиентов.
        <br>
    </p>
    <p>
        Если говорить о <b>сайтах для бизнеса</b> то их весьма условно можно разделить на 3 основные категории.<br>
    </p>
    <b>Итак:</b><br>
    <h2 id="sait_vizitka" class="header_shadow anchors">Сайт визитка</h2>
    <p>
        <img width="250" height="171" class="resp_img no_shadow no_border align-left img-outs2"
             src="/img/main_img/vizitka.png" alt="сайт визитка" title="сайт визитка">
        Идеальный вариант для старта в интернете. В дальнейшем можно улучшать и развивать возможности сайта и его
        наполнение.<br>
        <strong>Сайт визитка</strong> — веб-ресурс, основное предназначение которого быстро и в яркой,
        запоминающейся форме представить Вашу компанию в сети интернет.<br>
        Обычно сайт визитка состоит из 5 разделов: <em>Главная страница, О компании, Услуги, Прайс лист, Контакты.</em>
        Несмотря на небольшие размеры такой сайт - основной инструмент для деятельности предпринимателей
        в сети интернет и содержит все необходимое для бизнеса.<br>
    </p>
    <h3>Заказав у нас сайт визитку вы получите:</h3>
    <ul class="list list_block">
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;5-7 страниц информации на сайте</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Размещение прайс листов</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Форму обратной связи и(или) заявки на сайте</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Схему проезда до вашей организации</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Регистрацию и покупку домена</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Регистрацию в поисковых системах Яндекс и Google</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Валидный <abbr
                    title="англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины">HTML</abbr>
            код
        </li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Оптимизированную для <abbr
                    title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
            структуру страниц
        </li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Установку счетчика посещений</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
    </ul>
    <p></p>
    <p>
        Создание сайтов этой категории обычно занимает 5-7 дней после написания брифа
        и утверждения структуры, дизайна.<br>
        <strong>Цена для сайта визитки</strong> от <span class="red">7&#8202;000</span><span
                class="fa fa-ruble-sign"></span><br>
        <a href="/#contacts" title="заказать сайт визитку" class="zayavka link-anim"><span
                    class="fab fa-telegram-plane no-sh"></span> сделать заявку на сайт визитку</a>
    </p>
    <div class="hr"></div>
    <h2 id="korporativniy_sait" class="header_shadow anchors">Корпоративный сайт</h2>
    <p>
        <img width="250" height="136" class="resp_img no_border no_shadow align-left img-outs3"
             src="/img/main_img/corp.png" alt="корпоративный сайт" title="корпоративный сайт">
        Веб-ресурс с множеством задач от повышения престижа организации до
        продвижения товаров.
        Создании сайтов этой категории требует индивидуального подхода и по цене ощутимо выше чем для простых сайтов.
        В первую очередь из за большего объема работ, количества размещаемой информации, более тщательной
        проработки дизайна и других факторов. Работы выполняются после анализа рынка и сайтов конкурирующих
        компаний. По желанию заказчика пишутся положительные отзывы о компании.
    </p>
    <p>
        На <strong>создание корпоративного сайта</strong> как правило
        уходит от трех недель. Корпоративный сайт отличается от сайта визитки в первую очередь
        наличием системы управления контентом (CMS), каталога товаров с возможностью оперативного
        добавления(удаления) или изменения их описания. Возможно как написание индивидуальной CMS, учитывающей
        все потребности Вашего сайта так и вариант с готовыми CMS (Joomla, Wordpress, DLE). Следует сказать
        что "универсальные" cms достаточно сложны в использовании для неподготовленного человека и поэтому
        мы готовы написать для Вас систему управления контентом под Ваш конкретный сайт где внесение изменений
        будет не сложнее, чем например поменять фото в соцсетях :).<br>
        <strong>Цена для корпоративного сайта</strong> от <span class="red">12&#8202;000</span><span
                class="fa fa-ruble-sign"></span><br>
    </p>
    <h3>В цену включены:</h3>
    <ul class="list list_block">
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;До 50 страниц информации</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Базовая <abbr
                    title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
            оптимизация всех страниц
        </li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Каталог товаров и услуг</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Микроразметка для товаров и контактов</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Форма обратной связи(заявки)</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Система управления контентом</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Новости или блог</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Регистрация в поисковых системах</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Счетчик посетителей</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Настройка систем Яндекс метрика и Google analitics</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Cопровождение после сдачи в течении 3 месяцев</li>
    </ul>
    <br>
    <a href="/#contacts" title="заказать корпоративный сайт" class="zayavka link-anim"><span
                class="fab fa-telegram-plane no-sh"></span> сделать заявку на корпоративный сайт</a>
    <div class="hr"></div>
    <h2 id="internet_magazin" class="header_shadow anchors">Интернет магазин</h2>
    <p>
        <img width="250" height="209" class="resp_img no_border no_shadow align-left" src="/img/main_img/market.jpg"
             alt="интернет иагазин" title="интернет магазин">
        <strong>Интернет магазин</strong> — наиболее перспективный и развивающийся вид бизнеса в интернете.
        Создание сайтов такого уровня имеет свои особенности. Это обязательное наличие системы для
        добавления и удаления товара, каталога товаров, корзины покупателя, быстрого поиска товаров, удобной формы для
        заказа товара. Конечно же обязательно наличие базы данных для клиентов.
    </p>
    <p>
        Онлайн магазин наиболее удобный способ для осуществления продаж не требующий затрат на аренду и
        оптимален для их увеличения. Так же минимизированы затраты на персонал в торговом зале. Стоимость
        создания интернет магазина зависит от таких факторов: объема каталога товаров, интеграции с
        платежными системами, интеграции сайта с системой 1С, наличия авторизации пользователей и др.
        Сроки исполнения для <strong>интернет магазина</strong> от трех недель.
        <strong>Цена для интернет магазина</strong> от <span class="red">20&#8202;000</span><span
                class="fa fa-ruble-sign"></span><br>
    </p>
    <h3>Цена включает:</h3>
    <ul class="list list_block">
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Внутреннюю оптимизацию всех страниц</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Наполнение сайта содержимым</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Поиск по товарам</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Систему для добавления/удаления товара</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Корзину покупателя</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Удобную форму для заказа товара покупателем</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Продающие <abbr
                    title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
            тексты
        </li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Счетчик посещений</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Настройку целей в Яндекс метрике</li>
        <li><span class="fa fa-check logo"></span>&nbsp;&nbsp;Техническое сопровождение сайта в течении 3 месяцев</li>
    </ul>
    <br>
    <a href="/#contacts" title="заказать разработку интернет магазина" class="zayavka link-anim"><span
                class="fab fa-telegram-plane no-sh"></span> заказать разработку интернет магазина</a>
    <div class="hr"></div>
    <p>
        На практике получить привлекательный по дизайну (или как минимум не вызывающий отторжения)
        и удобный для посетителя сайт не такая тривиальная задача, как видится
        на первый взгляд. Для создания приятного и простого в использовании сайта, красиво
        представляющего контент, хорошо читаемого и без ненужных излишеств, требуется приложить некоторые усилия.
        Как правило, большинство вебмастеров часто пренебрегают фактором юзабилити(англ. usability — дословно
        «возможность использования», «способность быть использованным», «полезность») сайтов, что немного прискорбно.
        Поэтому создание сайтов нужно доверять слаженной команде специалистов, способных выполнить эту
        многоступенчатую работу в заранее оговоренные сроки.
    </p>
    <div>
        <img width="250" height="208" class="resp_img no_border no_shadow align-left img-outs4" src="/img/main_img/response.png"
             alt="адаптивная верстка" title="адаптивная верстка">
        <h2 id="response" class="header_shadow">Создание сайтов с адаптивным дизайном</h2>
        <p>
            <strong>Адаптивная верстка</strong> или <strong>адаптивный дизайн</strong> (респонсивный дизайн, отзывчивый
            дизайн, responsive web design, RWD)—
            направление в веб дизайне, когда ресурс должен быть одинаково удобным для просмотра и без потери функционала
            читаем на
            любых устройствах вне зависимости от ширины экрана. Будь то смартфон, планшет, ноутбук, настольный
            компьютер, проектор или даже устройство, которого еще нет, но появится в будущем.
        </p>
        <p>
            Сайт, который Вы сейчас видите разработан с учетом минимальной ширины экрана 340 пикселей без
            горизонтального скролла. Вы можете попробовать уменьшить окно вашего браузера и нажав кнопку "обновить"
            или клавишу F5 увидите, как изменилась страница. При определенной ширине экрана левое меню исчезнет
            и вместо него появиться знакомый многим "гамбургер", верхнее меню уменьшится в размерах
            или сложиться "в два" или "в три этажа", уменьшатся в размерах некоторые изображения и часть шрифтов.
            Это лишь один из возможных способов добиться адаптивного дизайна.
        </p>
        <p>
            <strong>Создание сайтов с адаптивным дизайном</strong> сегодня является правилом хорошего тона при
            веб разработке. Мы готовы предоставить услуги как по созданию адаптивных сайтов,
            так и по редизайну существующих сайтов с учетом адаптивности.
        </p>
    </div>
</article>