<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Last-Modified:' . gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
$this->title = $data['title'];
//$this->registerMetaTag(['name' => 'keywords', 'content' => $data[0]['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $data['description']]);
?>

<?php $this->beginBlock('h1'); ?>
Продвижение сайтов
<?php $this->endBlock(); ?>
    <script>
        window.document.title = "<?= $data['title'] ?>";
        document.getElementById('top_h').innerText = 'Продвижение сайтов';
    </script>
<?php
//echo $data['page_text'];
?>


<article>
    <img width="250" height="144" class="resp_img" src="/img/main_img/seo.jpg" alt="продвижение сайтов" title="продвижение сайтов">
    <h2 id="base_seo" class="header_shadow">Продвижение сайта, необходимый минимум и с чего начинается раскрутка
        сайта</h2>
    <h3>Продвижение сайта и базовая <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr><sup class="prim">*</sup> оптимизация</h3>
    <p>
        Обычно вопрос нужно ли продвижение сайта возникает вскоре после того, как Ваш сайт появился в сети интернет.
        Мы профессионально занимаемся оказанием услуг физическим и юридическим лицам, планирующим активную
        маркетинговую деятельность в сети.
    </p>
    <p>
        <mark><strong>Раскрутка сайта</strong> <b>малоэффективна</b></mark>
        ,(или даже бессмысленна) если внутренняя структура страниц не подчиняется
        определенным правилам.
        Что бы добиться структурной и семантической правильности страниц и проводится
        <mark><strong>базовая <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
                оптимизация.</strong></mark>
        <br>
        Базовая <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
        оптимизация начинается с написания правильных мета тегов таких как <code>description</code> и наличия
        ключевых слов в теге <code><b>title</b></code>.
        Положительное влияние на продвижение сайта так же оказывает наличие заголовков H1 и далее, их
        правильная структура и наличие ключевых фраз в них, оптимизация изображений и тега <code><b>alt</b></code>,
        написание привлекательного для посетителей сниппета. На этом этапе, который идет в процессе верстки мы
        добиваемся корректности внутренней структуры страниц с точки зрения поисковых машин и соответствия
        стандартам консорциума <abbr title="англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины">W3C.</abbr><sup class="prim">**</sup>
    </p>
    <p>
        Благоприятное действие на продвижение сайта оказывает так же их корректное
        отображение на мобильных устройствах.
        Ну и конечно правильная орфография всех текстов Вашего сайта. (Даже если у вас красный диплом филолога
        и вы уверены в правописании необходимо будет проверить текст в специальных сервисах поисковых систем,
        ведь Яндекс может считать по другому).
    </p>
    <p>
        Сразу же после выкладки на выбранный хостинг мы регистрируем Ваш
        сайт в поисковых системах Яндекс и Google и(по желанию заказчика) устанавливаем счетчики посещений.
        Настраивается правильная отдача сервером заголовков <code><b>LastModified</b></code>, проводиться склейка
        зеркал.
        Создаются файлы <code><b>sitemap.xml</b></code> и <code><b>robots.txt</b></code>. Возможно сделать
        автоматическую генерацию файла <code><b>sitemap.xml</b></code>.
    </p>
    <p>
        <b class="underline">Примечания:</b><br>
        <em>
            <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем"><b>SEO</b></abbr>
            (search engine optimization) — оптимизация для поисковых машин, в народном фольклоре
            продвижение или раскрутка сайта.<br>
            <abbr title="англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины"><b>W3C</b></abbr>
            (World Wide Web Consortium) — всемирный консорциум по интернету.
        </em>
    </p>
</article>
<div class="hr"></div>
<article>
    <h2 id="key_seo" class="header_shadow anchors">Продвижение сайта (раскрутка сайта) по ключевым фразам</h2>
    <p>
        В первую очередь необходимо ответить на несколько важных вопросов:<br>
        Для чего вам нужен сайт ?<br>
        Для чего сайт нужен вашим пользователям ?<br>
        Чем он лучше/хуже других похожих сайтов ?<br>
        Какая целевая аудитория Вашего сайта ?<br>
        Ведь вполне может быть что именно для Вашего сайта эффективней окажется не <strong><abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
            продвижение</strong> а например,&nbsp;<b><a href="#reklama" class="list_link">контекстная реклама</a></b>.
    </p>
    <p>
        Следует сразу сказать что поисковые машины не <i>индексируют сайты,</i> они <strong>индексируют
            страницы!</strong><br>
        И тут самая частая ошибка горе seo-оптимизаторов это приземление всех запросов на главную страницу сайта.
        Но раз термин <strong>продвижение сайта</strong> уже давно закрепился то и мы будем использовать его.<br>
        На этапе продвижения по ключевым словам проводиться анализ конкурентов, составление семантического ядра сайта и
        выбор приземляющих страниц(
        <b>ключевая страница</b>, <b>приземляющая страница</b>, <b>jump page</b>, <b>landing page</b>, <b>точка
            входа</b>) однозначно отвечающих на запрос пользователя
        (запросы семантического ядра), привязка запросов к страницам сайта, внутренняя перелинковка и другая
        оказывающая важное влияние на продвижение сайта работа.<br>
        Обязательно проверяется текст на удобочитаемость, уникальность, плотность ключевых слов, заспамленность и
        рекламный шум.
        При необходимости пишутся и размещаются положительные отзывы о компании.

    </p>
    <p>
        После того как работа над внутренней структурой сайта закончена начинается продвижение сайта
        с учетом внешних факторов.Это в первую очередь наращивание ссылочной массы за счет регистрации в
        "белых" каталогах, покупки "вечных" ссылок, использования сервис агрегаторов а так же блоговое и
        статейное продвижение сайта. Проводиться настройка целей в системах Яндекс метрика и Google analitics.<br>
        Мы используем <b>только легальные способы продвижения</b>. "Черная" SEO оптимизация не наш профиль!
    </p>
    <div id="seo_list">
        <h3 class="header_shadow">SEO продвижение сайта, основные требования к ресурсу:</h3>
        <ul>
            <li>Все доступы и права принадлежат владельцу сайта</li>
            <li>Возраст ресурса превышает 1 год</li>
            <li>Сайт находиться в работоспособном состоянии</li>
            <li>Хостинг соответствует заявленным требованиям скорости/нагрузки</li>
            <li>Сайт не аффилирован и не имеет однотипного поддомена</li>
            <li>Сайт является основным зеркалом</li>
            <li>Сбалансированное семантическое ядро</li>
            <li>Контент</li>
            <li>Сайт не содержит запрещенных законом материалов</li>
            <li>На сайте информативная входная страница</li>
        </ul>
    </div>
    <br>
    <p>
        Стоимость на продвижение сайта по ключевым фразам зависит от многих факторов: <br>
        коммерческой популярности запроса, возраста сайта и др.
    </p>
    <a href="/#contacts" title="продвижение сайта стоимость" class="zayavka link-anim"><span class="far fa-paper-plane no-sh"></span> узнать стоимость продвижения для Вашего сайта</a><br>
    <br>
</article>
<div class="hr"></div>
<article>
    <h2 id="context" class="header_shadow anchors">Контекстная реклама</h2>
    <!-- <h3 class="header_shadow">Контекстная реклама. Что это?</h3> -->
    <p>
        SEO продвижение сайта в топ 10 яндекса может занять от 3 до 6 месяцев в зависимости от ряда
        факторов. Да и стоит это ощутимых денег. Совсем нередко стоимость SEO продвижения сайта превышает стоимость
        разработки самого сайта.Что же делать если коммерческая отдача нужна незамедлительно?
    </p>
    <p>
        Выход есть! Вам на помощь придет <strong>контекстная реклама</strong>.<br>
    </p>
    <p>Пользователи ежедневно заходят на разные тематические сайты раздраженно выключая всевозможные
        рекламные баннеры и игнорируя назойливые объявления. Совсем другой случай когда пользователь при
        посещении Яндекса видит текстовый блок по интересующей его тематике. Вкратце это и есть контекстная
        реклама. При этом информация о Вашем сайте попадает в топ выдачи Яндекса независимо от того на
        какой позиции он реально находиться.
    </p>
    <p>
        Если вы обращали внимание на надпись "реклама" в поисковой выдаче Яндекса или Google то это оно и есть.<br>
        Пользователь заходит на поисковик, вводит свой запрос и видит примерно
        следующее:
    </p>
    <figure class="kontext_img">
        <img width="400" height="382" class="resp_img" src="/img/main_img/yandex.jpg" alt="контекстная реклама на Яндекс" title="контекстная реклама на Яндекс">
        <figcaption class="strong_text">Так может выглядеть реклама на Яндекс</figcaption>
    </figure>
    <figure class="kontext_img">
        <img width="400" height="382" class="resp_img" src="/img/main_img/google.jpg" alt="контекстная реклама на Google" title="контекстная реклама на Google">
        <figcaption class="strong_text">Контекстная реклама на Google Adwords</figcaption>
    </figure>
    <p class="clear">
        То, что выделено на фото красной рамкой и есть контекстная реклама. Туда можете попасть
        и Вы.
        Для этого нужно составить грамотный список ключевых фраз наиболее релевантных
        роду деятельности Вашей фирмы и уже на их основании написать привлекательные для потенциальных клиентов
        объявления с
        заголовками.
    </p>
    <p>
        К плюсам контекстной рекламы относиться также то, что Вы платите лишь за непосредственный переход
        на Ваш сайт и сами устанавливаете цену за клик. Чем выше Вы заявили стоимость перехода,
        тем выше будет Ваша позиция на странице выдачи поисковика (действует аукционный принцип). Можно также настроить
        выдачу в зависимости
        от времени суток или от географической привязки. Например, объявление "доставка пиццы" показывать
        с 11<sup>00</sup> до 14<sup>00</sup>(т.е. в обеденное время) в регионе Чебоксары.
    </p>
    <h3 class="header_shadow">Настройка контекстной рекламы</h3>
    <p>
        Мы готовы профессионально провести рекламную компанию Вашей фирмы в Яндекс и Google
        по современным маркетинговым техникам. Составим объявления, подберем популярные ключевые слова, соответствующие
        роду деятельности Вашей организации.
    </p>
    <p>
    </p><ul>
        <li><strong>Настройка рекламы на Яндекс</strong> <span class="red">3&#8202;000</span> <span class="fa fa-ruble-sign"></span></li>
        <li><strong>Настройка рекламы на Google</strong> <span class="red">3&#8202;000</span> <span class="fa fa-ruble-sign"></span></li>
        <li><strong>Настройка рекламы на Яндекс Директ и Google Adwords</strong> <span class="red">4&#8202;500</span> <span class="fa fa-ruble-sign"></span> (единоразово)
        </li>
    </ul>
    <strong>Профессиональное ведение рекламной кампании</strong> от <span class="red">3&#8202;000</span> <span class="fa fa-ruble-sign"></span>/месяц<br>
    <span class="strong_text">При заказе сайта от <span class="red">40&#8202;000</span> <span class="fa fa-ruble-sign"></span> настройку проведем <b class="underline">БЕСПЛАТНО.</b></span>
    <p></p>
    <h2>Продвижение сайта методами <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
        или контекстная реклама, что выбрать?</h2>
    <p>
        Следует сказать, что контекстная реклама абсолютно не влияет на позицию сайта в поисковой выдаче.
        Поэтому большинство компаний используют оба инструмента (и <b>контекстную рекламу</b> и <b>SEO продвижение</b>)
        для наибольшей эффективности. Еще отметим что результат от контекстной рекламы очень скор, но и пропадет сразу
        как закончатся Ваши деньги на счету того же яндекса т.е. платить придется
        постоянно (впрочем, как и в любой другой рекламе). Для продвижения сайта ситуация другая —
        результата приходится ждать обычно до 3 месяцев (иногда более) но и результат долгосрочный. При грамотном
        продвижении
        сайта подвинуть его из топа будет не так просто (мы не занимаемся "черным" продвижением когда сайт
        за 2 недели попадает в топ а затем вылетает в бан). В нашей практике были случаи когда сайт уже после
        прекращения <abbr title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr> продвижения висел в топе еще 2 года.<br> Поэтому наша рекомендация — применяйте
        и <b>продвижение сайта</b> и <b>контекстную рекламу!</b>
    </p>
</article>
