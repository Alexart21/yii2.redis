const screen_w = document.body.clientWidth;
const screen_h = document.body.clientHeight;
window.onresize = function () {
    window.screen_w = document.body.clientWidth;
    window.screen_h = document.body.clientHeight;
};

/*Мобильное левое меню*/
function mobLeft() {
    const menuBtn = document.querySelector('.mob-menu-button'); //кнопка
    const menu = document.querySelector('.mob-menu-list'); // выезжающий блок
    const menuCol = document.querySelector('.mob-menu-col'); // "колонка"
    const mobLink = document.querySelectorAll('.mob-link'); // ссылки в меню
    // let y = menuBtn.getBoundingClientRect().top; // запоминаем смещение по y
    menu.style.height = screen_h + 'px'; // высоту выехавшему блоку по всей высоте
    menuBtn.addEventListener('click', function () {
        let has = menuBtn.classList.contains('btn-pos');
        menu.classList.toggle('menu-animate');
        menuBtn.classList.toggle('btn-pos');
        menuCol.classList.toggle('open');
    });
    const c = mobLink.length;
    // чтоб меню закрывалось при клике на любую ссылку
    for (let i = 0; i < c; i++) {
        mobLink[i].addEventListener('click', function () {
            menu.classList.toggle('menu-animate');
            menuBtn.classList.toggle('btn-pos');
            menuCol.classList.toggle('open');
        });
    }
}

/* кнопка наверх */
const scr = document.getElementById('scroller');
window.addEventListener('scroll', () => {
    let top = window.pageYOffset; // сколько проскролено
    if (top > 500) {
        scr.style.display = 'block';
    } else {
        scr.style.display = 'none';
    }
});
scr.addEventListener('click', () => {
    // $('body,html').animate({scrollTop: 0}, 300);
    window.scrollTo(0, 0);
});

/* фиксация верхнего меню */
function menu_fix() {
    const h_hght = 500; // высота шапки
    const h_mrg = 0; // отступ когда шапка уже не видна
    $(function () {
        let top = $(this).scrollTop(); // сколько проскролено
        const menu = $('#menu_outer'), // блок меню
            resp = $('nav.resp'),
            ul = $('nav.resp ul'),
            link = $('.resp a');
        if ((top + h_mrg) > h_hght) { // включается "скролл-меню"
            menu.css({
                'top': h_mrg,
                'position': 'fixed',
                'background': 'transparent',
                'z-index': '10'
            });
            resp.css({
                'border': 'none',
                'marginTop': '-20px',
            });
            ul.addClass('scrolled');
            link.css({
                'color': '#313A3D',
                'borderRight': '1px dotted #e61b05'
            });
        } else {
            menu.css({
                'top': 0,
                'position': 'relative',
                'background': '',
                'z-index': ''
            });
            resp.css({
                'background-color': '',
                'border': '',
                'marginTop': ''
            });
            ul.removeClass('scrolled');
            link.css({
                'color': '',
                'borderRight': ''
            });
        }
    });
}

//
$(window).scroll(function () {
    menu_fix(); // фиксация верхнего меню
});

/* Кастомный алерт */
/*function alert(content, afterFunction) {
    $('<div class="alertm_overlay"></div>').appendTo('body');
    $('<div class="alertm_all"><a href="#" onclick="alert_close(' + afterFunction + '); return false" class="alertm_close">x</a><div class="alertm_wrapper">' + content + '</div><div class="alertm_but" onclick="alert_close(' + afterFunction + '); return false">OK</div></div>').appendTo('body');
    $(".alertm_overlay, .alertm_all").fadeIn("slow");
    $('.alertm_all').css('margin-top', (-1) * ($('.alertm_all').height()) + 'px');
}

function alert_close(afterFunctionClouse) {
    $(".alertm_overlay, .alertm_all").remove();
    afterFunctionClouse;
}*/

// доставание cookie
function readCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

/////////////
/* Далее в обертке window.onload */
window.onload = () => {
    // анимация в шапке
    const shtorka = document.querySelector('.shtorka');
    shtorka.classList.add('shtorka-animate');
    mobLeft(); // мобильное меню
    //
    (function ($) {
        new WOW().init();
    })(jQuery);

    // Окно чата/мессенджеров
    let msgBlock = document.getElementById('msg-block'),
        msgContent = document.getElementById('msg-content'),
        msgImg = document.querySelector('.msg-img'),
        msgClosed = document.querySelector('.msg-closed');

    const al = document.getElementById('container').clientWidth;
    msgBlock.style.right = (screen_w - al) / 2 + 'px'; //позиционируем в правый край родителя

    const showMsg = () => { // показ окна чата с анимацией
        $('#msg-block').velocity('transition.bounceIn');
        msgBlock.style.display = 'block';
    }
    /* Всплывающая подсказка над чатом */
    const showTooltip = () => {
        if(msgBlock.hasAttribute('data-closed') && !readCookie('msg')){ // только при свернутом окошке и нету куки (не заходил больше часа или сколько там)
            let promise = document.querySelector('audio').play();
            if (promise !== undefined) {
                promise.then(_ => {
                    console.log('play!');
                }).catch(err => {
                    console.log(err.message);
                });
            }
            $('[data-toggle="tooltip"]').tooltip('show');
            document.cookie = "msg=1;max-age=3600"; // куку на час(в течении этого времени больше не будет всплывающих подсказок)
        }
    };
    //
    const rmTooltip = () => { // прибиваем
        let tltp = document.querySelector('.tooltip');
        if(tltp){
            tltp.remove();
        }
    };
    //
    setTimeout(showMsg, 3000); // задержки
    setTimeout(showTooltip, 6000);
    setTimeout(rmTooltip, 14000);
    msgBlock.addEventListener('mouseover', () => { // по наведению мыши тож прибиваем
        rmTooltip();
    });
    msgContent.addEventListener('click', () => { // разворачиваем окно чата
        if (msgBlock.hasAttribute('data-closed')) { // свернуто
            msgBlock.style.height = '370px';
            msgBlock.style.background = 'url(/img/wats-bg.gif)';
            msgBlock.style.boxShadow = '0 0 30px #999';
            msgImg.style.left = '120px';
            msgClosed.style.display = 'none';
            msgBlock.removeAttribute('data-closed');
            showMsg();
        }
    });
    //
    const msgClose = document.querySelector('#msg-block button');
    msgClose.addEventListener('click', () => { // сворачиваем окно чата
        if (!msgBlock.hasAttribute('data-closed')) { // окно не свернуто
            msgImg.style.left = '240px';
            msgBlock.style.height = '';
            msgBlock.style.background = '';
            msgBlock.style.boxShadow = '';
            msgClosed.style.display = '';
            msgBlock.setAttribute('data-closed', '');
        }
    });
    //
    $(document).on('pjax:beforeSend', () => {
        document.body.style.cursor = 'progress';
        let method = $.pjax.options.type; // (GET или POST)
        let target = $.pjax.options.container; // контейнер куда грузим AJAX данные
        if (target == '#my-modal' && method == 'GET') { // вызов модального окна(обратный звонок)
            $('#container').prepend('<div id="overlay"></div>');
            $('#overlay').show();
            $('#container_loading').show();
        } else if (method != 'POST') { // данные в блок #inc (основной контент)
            const inc = document.querySelector('#inc');
            const incOverl = document.querySelector('#inc-overlay');
            incOverl.style.width = inc.clientWidth + 'px';
            incOverl.style.height = inc.clientHeight + 'px';
            incOverl.style.left = inc.offsetLeft + 'px';
            incOverl.style.top = inc.offsetTop + 'px';
            scrollTo(0, 0);

            $('#inc-overlay').css('display', 'block');
            $('#container_loading').show();
        }
    });

    $(document).on('pjax:complete', () => {
        let target = $.pjax.options.container; // контейнер куда грузим AJAX данные
        if (target == '#inc') {
            linkColor(); // красим активную ссылку
        }
        document.body.style.cursor = 'default';
        $('#overlay').remove();
        $('#container_loading').hide();
        $('#inc-overlay').css('display', 'none');
        let method = $.pjax.options.type;
        if (method == 'POST' && $.pjax.options.url == '/') { // очищаем поля формы отправки письма
            document.forms[0].reset();
        }
        // Ratelimiter сработал (ПРЕВЫШЕНО КОЛ-ВО ПОПЫТОК ВХОДА)
        // Куки сохранял в action site/login
        $(document).on('pjax:error', (event, xhr, textStatus, errorThrown, options) => {
            if (xhr.status == 429) {
                alert('Количество попыток исчерпано.Не более ' + readCookie('rateLimit') + ' попыток в минуту');
            }
        });
    });
};

// окраска активной AJAX ссылки верхнего меню
function linkColor() {
    let links = document.querySelectorAll('.resp li a'); // все ссылки верхнего меню
    let currentLink = window.location.pathname; // нажатая ссылка
    for (var i = 0; i < links.length; i++) {
        let y = links[i].pathname;
        if (y == currentLink && currentLink != '/') {
            links[i].classList.add('header_shadow');
        } else {
            links[i].classList.remove('header_shadow');
        }
    }
}

/* Параграф "этапы создания сайта" на главной странице */
const etap = [ // массив с описаниями
    "Уяснение задач заказчика, определение целевой аудитории сайта, написание брифа(в народном фольклоре ТЗ).Прототипирование или составление эскиза где определяются расположения элементов страниц.",
    "Определение концепции дизайна.Цветовое и графическое решение будущего сайта, выбор шрифтов и др.",
    "Страницы сайта должны корректно отображаться во всех браузерах.Как правило хорошего тона нынче можно говорить об <a class=\"portf-call\" href=\"/sozdanie#response\"><b> адаптивной верстке</b></a> т.е. сайт должен быть хорошо читаем без потери функционала и на смартфонах и на планшетах и на настольных пк, и даже на тех устройствах, которые появятся в будущем.",
    "Программирование идет параллельно с версткой.Постановка сайта \"на движок\" выбранный заказчиком(или разработанный нами).Проектирование и наполнение контентом базы данных(если требуется).Можем предложить собственную CMS которая в отличии от \"универсальных\" будет заточена под Ваш конкретный сайт и очень проста в использовании.",
    "Наполнение содержимым.Если сайт будет продвигаться в поисковиках, пишутся грамотные SEO тексты под поисковые запросы по ключевым словам.",
    "Здесь идет полная проверка работоспособности сайта.Так же тестируется стойкость к XSS атакам и SQL инъекциям.",
    "Собственно выкладка на выбранный хостинг.Этот этап может быть сделан уже в процессе верстки.Например когда коммерческий сайт планируеться к SEO продвижению.Ведь SEO&mdash; процесс нескорый и тут время-деньги."
];
let selectedLi;
const etli = document.querySelector('#etap ul');
etli.onclick = (e) => {
    let li = e.target;
    if(!li) return;
    highlight(li);
};

function highlight(li) {
    if (selectedLi) { // убрать существующую подсветку, если есть
        selectedLi.classList.remove('etap_active');
    }
    selectedLi = li;
    selectedLi.classList.add('etap_active'); // подсветить новый li
    let n = selectedLi.dataset.n;
    document.getElementById('etap_target').innerHTML = etap[n]; // впендюриваем описание куда надо
}