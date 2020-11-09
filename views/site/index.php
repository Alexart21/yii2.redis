<?php
//var_dump($data[0]['title']);die;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

header('Last-Modified:' . gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
$this->title = $data['title'];
$this->registerMetaTag(['name' => 'description', 'content' => $data['description']]);
?>
    <script>
        window.document.title = "<?= $data['title'] ?>";
        document.getElementById('top_h').innerText = 'Создание и продвижение сайтов';
    </script>
<!-- <section> -->
<article>
    <img width="250" height="179" class="resp_img" src="/img/main_img/web2.jpg" alt="веб дизайн" title="веб дизайн">
    <h2 class="header_shadow">Алекс-арт21 — создание только эффективных сайтов</h2>
    <p>
        У нас сформирован профессиональный коллектив из дизайнеров, web-разработчиков, <abbr
                title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
        специалистов.
        Каждый из нас отлично знает свое дело, будь то
        разработка дизайн-макета сайта-визитки или проектирование базы данных интернет магазина. Все вместе мы
        уже команда способная решить поставленные задачи в установленные сроки.
    </p>
    <p><strong class="mark">Мы не просто делаем сайты "под ключ", но и предоставляем комплексные и эффективные решения
            для современного бизнеса.</strong>
    </p>
    <p class="strong_text">
        Разрабатываем только современные сайты и добиваемся роста посещаемости и конверсии.
        <br/>
        Применяем только бизнес подход ориентированный не на "креативность", а на результат.
        <br/>
        Предлагаем только свежие решения.
        <br/>
    </p>
    <h3 class="h_2 punkt no_border">Предоставляемые услуги:</h3>
    <div id="uslugi_outer" class="list_block">
        <ul id="uslugi">
            <li>
                <span class="fa fa-check"></span><strong><a title="создание сайтов" class="list_link link-anim portf-call"
                                                            href="/sozdanie">создание сайтов</a></strong>
            </li>
            <li>
                <span class="fa fa-check"></span><strong><a title="создание сайтов" class="list_link link-anim portf-call"
                                                    href="/sozdanie">создание сайтов</a></strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="редизайн сайтов">редизайн существующих сайтов</strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="модернизация сайтов">модернизация сайтов под стандарты <abbr
                            title="англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины">HTML5</abbr>
                    и <abbr
                            title="англ. Cascading Style Sheets, version 3 — каскадные таблицы стилей">CSS3</abbr></strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong>
                    <a title="адаптивная верстка" class="list_link link-anim" href="/sozdanie#response">адаптивная
                        верстка</a>
                </strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="постановка статичных html сайтов на движок">постановка статичных html сайтов на
                    "движок"</strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="разработка системы управления сайтом">разработка индивидуальной <abbr
                            title="англ. Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом">CMS</abbr></strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong>
                    <abbr
                            title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO </abbr><a
                            title="продвижение сайтов" class="list_link link-anim portf-call" href="/prodvijenie">продвижение
                        сайтов</a>
                </strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong>
                    <a title="контекстная реклама" class="list_link link-anim" href="/prodvijenie#context">контекстная
                        реклама</a>
                    на Яндекс и Google</strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="рерайт копирайт">наполнение оригинальным контентом (рерайт, копирайт)</strong>
            </li>
            <li>
                <span class="fa fa-check"></span> <strong>консультации, обучение персонала</strong>
            </li>
            <li>
                <span class="fa fa-check"></span>
                <strong title="техническая и информационная поддержка веб-ресурсов">техническая и информационная
                    поддержка веб-ресурсов</strong>
            </li>
        </ul>
    </div>
    <br/>
    <br/>
    <div id="site">
        <div id="s1">
            <div class="site_block">
                <a href="/sozdanie#sait_vizitka" class="portf-call" title="сайт визитка">
                    <h2 class="h_2 punkt link-anim">Сайт визитка</h2>
                </a>
                <p>
                    Идеальный вариант для старта в интернете.
                    <br>
                    В дальнейшем можно улучшать и развивать
                    <br>
                    возможности сайта и его наполнение.
                    <br/>
                </p>
                <ul>
                    <li>
                        <span class="fa fa-check"></span>
                        до 5 страниц информации
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        размещение прайс листов
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        форма обратной связи
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        срок исполнения от 7 дней
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        цена от
                        <span class="red">7&#8202;000</span>
                        <span class="fa fa-ruble-sign"></span>
                    </li>
                </ul>
                <a href="/#contacts" title="заказать сайт визитку" class="zayavka link-anim"><span class="fa fa-send-o no-sh"></span> заказать сайт визитку</a>
            </div>
        </div>
        <div id="s2">
            <div class="site_block">
                <a href="/sozdanie#korporativniy_sait" class="portf-call" title="корпоративный сайт">
                    <h2 class="h_2 punkt link-anim">Корпоративный сайт</h2>
                </a>
                <p>
                    Многофункциональный портал для компании
                    <br>
                    и важный маркетинговый инструмент для
                    <br>
                    продвижения ваших товаров и(или) услуг.
                    <br>
                </p>
                <ul>
                    <li>
                        <span class="fa fa-check"></span>
                        каталог товаров и услуг
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        система управления сайтом
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        базовая <abbr
                                title="англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем">SEO</abbr>
                        оптимизация
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        срок исполнения от 21 дня
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        цена от
                        <span class="red">12&#8202;000</span>
                        <span class="fa fa-ruble-sign"></span>
                    </li>
                </ul>
                <a href="/#contacts" title="заказать корпоративный сайт" class="zayavka link-anim"><span class="fa fa-send-o no-sh"></span> заказать корпоративный сайт</a>
            </div>
        </div>
        <div id="s3">
            <div class="site_block">
                <a href="/sozdanie#internet_magazin" class="portf-call" title="интернет магазин">
                    <h2 class="h_2 punkt link-anim">Интернет магазин</h2>
                </a>
                <p>
                    Оптимально для увеличения продаж.
                    <br/>
                    Обязательно включает системы для добавления
                    товара и оформления заказа.
                    <br/>
                </p>
                <ul>
                    <li>
                        <span class="fa fa-check"></span>
                        полноценный интернет магазин
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        система управления сайтом
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        система добавления/удаления товаров
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        срок исполнения от 21 дня
                    </li>
                    <li>
                        <span class="fa fa-check"></span>
                        цена от
                        <span class="red">20&#8202;000</span>
                        <span class="fa fa-ruble-sign"></span>
                    </li>
                </ul>
                <a href="/#contacts" title="заказать интернет магазин" class="zayavka link-anim"><span class="fa fa-send-o no-sh"></span> заказать интернет магазин</a>
            </div>
        </div>
    </div>
    <div id="bonus">
        <h2 class="header_shadow">Для всех сайтов :</h2>
        <ul>
            <li>
                <span class="fa fa-asterisk logo"></span>
                Индивидуальный дизайн
            </li>
            <li>
                <span class="fa fa-asterisk logo"></span>
                Форма обратной связи(заявки)
            </li>
            <li>
                <span class="fa fa-asterisk logo"></span>
                Регистрация домена и размещение на выбранном хостинге
            </li>
            <li>
                <span class="fa fa-asterisk logo"></span>
                Регистрация в поисковых системах Яндекс и Google
            </li>
            <li>
                <span class="fa fa-asterisk logo"></span>
                Счетчик посетителей (по желанию заказчика)
            </li>
        </ul>
    </div>
    <h2 class="h_2 header_shadow">Процесс работы над сайтом и контакты с заказчиком</h2>
    <p>
        Взаимодействие с заказчиком идет на всем процессе создания сайта от первого телефонного звонка.
        На всю свою работу даем бессрочную гарантию. Обучим Ваш персонал если необходимо.
    </p>
    <p>
        Конечно же как и всякий уважающий себя коллектив мы беремся не за все заказы. Если встает выбор взяться
        за заказ или отклонить его то тут у нас действует нехитрое правило которое мы условно называем
        "правилом двух плюсов". Если из трех критериев а именно <b>проект</b>
        ,
        <b>гонорар</b>
        и
        <b>заказчик</b>
        нас устраивают минимум два, то мы беремся за заказ. За интересный проект можно взяться и при низкой
        оплате. Другой вариант — проект интересный, гонорар отличный, а заказчик невероятный зануда.
        Конечно же беремся (кто же откажется от денег :) ).
    </p>
    <div id="etap">
        <h2>Этапы создания сайта можно условно разделить на:</h2>
        <br/>
        <ul>
            <li class="link-anim" data-n="0">постановку целей</li>
            <li class="link-anim" data-n="1">дизайн</li>
            <li class="link-anim" data-n="2">верстку</li>
            <li class="link-anim" data-n="3">программирование</li>
            <li class="link-anim" data-n="4">наполнение</li>
            <li class="link-anim" data-n="5">тестирование</li>
            <li class="link-anim" data-n="6">запуск</li>
        </ul>
    </div>
    <output id="etap_target"></output>
    <br/>
</article>
<div>
    <strong class="h2">Мы используем <abbr title="Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом.">CMS</abbr> и <abbr title="Фре́ймворк (неологизм от framework — остов, каркас, структура) — программная платформа, определяющая структуру программной системы; программное обеспечение, облегчающее разработку и объединение разных компонентов большого программного проекта.">фреймворки</abbr> :</strong>
    <br>
    <br>
    <div>
        <span class="fab fa-joomla cms" style="color: #FF3F17"></span>
        <span class="fab fa-wordpress cms" style="color: #0079B1"></span>
        <span class="fab fa-drupal cms" style="color: #0079B1"></span>
        <img width="40" height="40" style="display: inline;margin-top: -26px" alt="Yii" src="data:image/png;base64,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">
        <svg style="margin-top: -26px" xmlns="http://www.w3.org/2000/svg" width="50" height="40" viewBox="0 0 84.1 57.6"><title>laravel</title><path fill="#fb503b" d="M83.8 26.9c-.6-.6-8.3-10.3-9.6-11.9-1.4-1.6-2-1.3-2.9-1.2s-10.6 1.8-11.7 1.9c-1.1.2-1.8.6-1.1 1.6.6.9 7 9.9 8.4 12l-25.5 6.1L21.2 1.5c-.8-1.2-1-1.6-2.8-1.5C16.6.1 2.5 1.3 1.5 1.3c-1 .1-2.1.5-1.1 2.9S17.4 41 17.8 42c.4 1 1.6 2.6 4.3 2 2.8-.7 12.4-3.2 17.7-4.6 2.8 5 8.4 15.2 9.5 16.7 1.4 2 2.4 1.6 4.5 1 1.7-.5 26.2-9.3 27.3-9.8 1.1-.5 1.8-.8 1-1.9-.6-.8-7-9.5-10.4-14 2.3-.6 10.6-2.8 11.5-3.1 1-.3 1.2-.8.6-1.4zm-46.3 9.5c-.3.1-14.6 3.5-15.3 3.7-.8.2-.8.1-.8-.2-.2-.3-17-35.1-17.3-35.5-.2-.4-.2-.8 0-.8S17.6 2.4 18 2.4c.5 0 .4.1.6.4 0 0 18.7 32.3 19 32.8.4.5.2.7-.1.8zm40.2 7.5c.2.4.5.6-.3.8-.7.3-24.1 8.2-24.6 8.4-.5.2-.8.3-1.4-.6s-8.2-14-8.2-14L68.1 32c.6-.2.8-.3 1.2.3.4.7 8.2 11.3 8.4 11.6zm1.6-17.6c-.6.1-9.7 2.4-9.7 2.4l-7.5-10.2c-.2-.3-.4-.6.1-.7.5-.1 9-1.6 9.4-1.7.4-.1.7-.2 1.2.5.5.6 6.9 8.8 7.2 9.1.3.3-.1.5-.7.6z"/></svg>
    </div>
    <pre>joomla wordpress drupal yii2 Laravel</pre>
</div>
<!-- </section> -->
    <br>
    <br>
    <br>
<!--noindex-->
    <div id="contacts" class="anchors"></div>
<div class="h1 text-center">Возникли вопросы ?</div>
<div class="h2 text-center">Напишите нам и получите исчерпывающую консультацию.</div>
<br>
<?php Pjax::begin([
    'clientOptions' => [
        'method' => 'POST',
        'url' => '/',
        'container' => '#my-modal',
    ],
    'enablePushState' => false, // не обновлять url
    'formSelector' => '#index-form',
    'timeout' => '20000',

]);
?>
<?php $form = ActiveForm::begin([
                  'id' => 'index-form',
                  'options' => [
                          'action' => '/',
                          'data-pjax' => true
                  ],
]);
?>
<div class="field name-box animated bounceInDown wow"  data-wow-delay="0.9s">
    <?= $form->field($indexForm, 'name')->textInput([
            'required' => true,
            'tabindex' => 1,
    ]); ?>
</div>

<div class="field email-box animated bounceInDown wow"  data-wow-delay="0.7s">
    <?= $form->field($indexForm, 'email')->textInput([
            'required' => true,
        'tabindex' => 2,
    ]); ?>
</div>

<div class="field tel-box animated bounceInDown wow" data-wow-delay="0.5s">
    <?= $form->field($indexForm, 'tel')
        ->widget(MaskedInput::className(), [
            'mask' => '+7 (999) - 999 - 99 - 99',
            'options' => [
                    'required' => true,
                'tabindex' => 3,
            ],
        ]);
    ?>
</div>


    <div class="field msg-box animated bounceInDown wow"  data-wow-delay="0.3s">
        <?= $form->field($indexForm, 'text')->textarea([
            'id' => 'msg',
            'placeholder' => 'Введите текст сообщения',
            'required' => true,
            'tabindex' => 4,
        ]); ?>
    </div>

<?/*= $form->field($indexForm, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
    [
        'siteKey' => '6LftVL4ZAAAAAPQq_Sj_9_6Cyguka6qMJpDJRyWs', // unnecessary is reCaptcha component was set up
    ]
) */?>

<?= $form->field($indexForm, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha3::className(),
    [
        'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
        'action' => 'index',
    ]
); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn success-button animated bounceInDown wow', 'data-wow-delay' => '0.1s']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>