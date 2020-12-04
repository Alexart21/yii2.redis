<?php
//var_dump($data[0]['title']);die;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

header('Last-Modified:' . gmdate("D, d M Y H:i:s \G\M\T", $data['last_mod']));
$this->title = $data['title'];
$desc = $data['description'] ? $data['description'] : '';
$this->registerMetaTag(['name' => 'description', 'content' => $desc]);
?>
    <script>
        window.document.title = "<?= $data['title'] ?>";
        document.getElementById('top_h').innerText = 'Создание и продвижение сайтов';
    </script>
<!-- <section> -->
<article>
    <img width="250" height="179" class="resp_img polygon1" src="/img/main_img/web2.jpg" alt="веб дизайн" title="веб дизайн">
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
                <a href="/#contacts" title="заказать сайт визитку" class="zayavka link-anim"><span class="far fa-paper-plane no-sh"></span> заказать сайт визитку</a>
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
                <a href="/#contacts" title="заказать корпоративный сайт" class="zayavka link-anim"><span class="far fa-paper-plane no-sh"></span> заказать корпоративный сайт</a>
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
                <a href="/#contacts" title="заказать интернет магазин" class="zayavka link-anim"><span class="far fa-paper-plane no-sh"></span> заказать интернет магазин</a>
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
    <table class="ftab">
        <tbody>
        <tr>
<!--            <td><span class="fab fa-joomla cms" style="color: #FF3F17"></span></td>-->
            <td><img alt="joomla" src="data:image/png;base64,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"></td>
            <td><span class="fab fa-wordpress cms" style="color: #0079B1"></span></td>
            <td><span class="fab fa-drupal cms" style="color: #0079B1"></span></td>
            <td><img width="40" height="40" alt="Yii" src="data:image/png;base64,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"></td>
            <td><svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" viewBox="0 0 84.1 57.6"><title>laravel</title><path fill="#fb503b" d="M83.8 26.9c-.6-.6-8.3-10.3-9.6-11.9-1.4-1.6-2-1.3-2.9-1.2s-10.6 1.8-11.7 1.9c-1.1.2-1.8.6-1.1 1.6.6.9 7 9.9 8.4 12l-25.5 6.1L21.2 1.5c-.8-1.2-1-1.6-2.8-1.5C16.6.1 2.5 1.3 1.5 1.3c-1 .1-2.1.5-1.1 2.9S17.4 41 17.8 42c.4 1 1.6 2.6 4.3 2 2.8-.7 12.4-3.2 17.7-4.6 2.8 5 8.4 15.2 9.5 16.7 1.4 2 2.4 1.6 4.5 1 1.7-.5 26.2-9.3 27.3-9.8 1.1-.5 1.8-.8 1-1.9-.6-.8-7-9.5-10.4-14 2.3-.6 10.6-2.8 11.5-3.1 1-.3 1.2-.8.6-1.4zm-46.3 9.5c-.3.1-14.6 3.5-15.3 3.7-.8.2-.8.1-.8-.2-.2-.3-17-35.1-17.3-35.5-.2-.4-.2-.8 0-.8S17.6 2.4 18 2.4c.5 0 .4.1.6.4 0 0 18.7 32.3 19 32.8.4.5.2.7-.1.8zm40.2 7.5c.2.4.5.6-.3.8-.7.3-24.1 8.2-24.6 8.4-.5.2-.8.3-1.4-.6s-8.2-14-8.2-14L68.1 32c.6-.2.8-.3 1.2.3.4.7 8.2 11.3 8.4 11.6zm1.6-17.6c-.6.1-9.7 2.4-9.7 2.4l-7.5-10.2c-.2-.3-.4-.6.1-.7.5-.1 9-1.6 9.4-1.7.4-.1.7-.2 1.2.5.5.6 6.9 8.8 7.2 9.1.3.3-.1.5-.7.6z"/></svg></td>
            <td><span class="fab fa-react" style="font-size: 44px;color: #37a4ff"></span></td>
        </tr>
        <tr>
            <th>joomla</th>
            <th>wordpress</th>
            <th>drupal</th>
            <th>yii2</th>
            <th>Laravel</th>
            <th>react</th>
        </tr>
        </tbody>
    </table>
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
//                    'required' => true,
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

<?/*= $form->field($indexForm, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha3::className(),
    [
        'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
        'action' => 'index',
    ]
); */?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn success-button animated bounceInDown wow', 'data-wow-delay' => '0.1s']) ?>
    </div>

<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
<script>
    /* Фиксируем "шторки" в контактной форме при фокусе */
        document.getElementById('index-form').addEventListener('focusin', (e) => {
            let el = e.target;
            let lbl = e.target.previousElementSibling; //<label>
            if (el.tagName != 'BUTTON'){
                // console.log(el);
                lbl.classList.add('fill');
            }
        });
</script>
