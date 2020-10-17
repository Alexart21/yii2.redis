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
    window.addEventListener('scroll', function (e) {
        let top = window.pageYOffset; // сколько проскролено
        if (top > 500) {
            scr.style.display = 'block';
        } else {
            scr.style.display = 'none';
        }
    });
    scr.addEventListener('click', function () {
        $('body,html').animate({scrollTop: 0}, 300);
    });

/* фиксация верхнего меню */
function menu_fix() {
    const h_hght = 500; // высота шапки
    const h_mrg = 0; // отступ когда шапка уже не видна
        $(function () {
            let top = $(this).scrollTop(); // сколько проскролено
            const menu = $('#menu_outer'); // блок меню
            const resp = $('nav.resp');
            const ul = $('nav.resp ul');
            const link = $('.resp a');
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
                ul.removeClass('scrolled')
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
function alert(content,afterFunction){
    $('<div class="alertm_overlay"></div>').appendTo('body');
    $('<div class="alertm_all"><a href="#" onclick="alert_close('+afterFunction+'); return false" class="alertm_close">x</a><div class="alertm_wrapper">'+content+'</div><div class="alertm_but" onclick="alert_close('+afterFunction+'); return false">OK</div></div>').appendTo('body');
    $(".alertm_overlay, .alertm_all").fadeIn("slow");
    $('.alertm_all').css('margin-top', (-1)*($('.alertm_all').height())+'px');
}
function alert_close(afterFunctionClouse){
    $(".alertm_overlay, .alertm_all").remove();
    afterFunctionClouse;
}

// доставание cookie
function readCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
/////////////
/* Далее в обертке window.onload */
window.onload = function () {
    // анимация в шапке
    const shtorka = document.querySelector('.shtorka');
    shtorka.classList.add('shtorka-animate');
    mobLeft(); // мобильное меню
    //
    (function ($) {
        new WOW().init();
    })(jQuery);

    // Окно чата/мессенджеров
    let msgBlock = document.getElementById('msg-block');
    let msgContent = document.getElementById('msg-content');
    let msgImg = document.querySelector('.msg-img');
    let msgClosed = document.querySelector('.msg-closed');

    const al = document.getElementById('container').clientWidth;
    msgBlock.style.right = (screen_w - al)/2 + 'px'; //позиционируем в правый край родителя

    function showMsg(){ // показ окна чата с анимацией
        $('#msg-block').velocity('transition.bounceIn');
    }

    setTimeout(showMsg, 3000); // задерживаем появление свернутого окошка

    msgContent.addEventListener('click', function () { // разворачиваем окно чата
        if(msgBlock.hasAttribute('data-closed')) { // свернуто
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
    msgClose.addEventListener('click', function () { // сворачиваем окно чата
        if (!msgBlock.hasAttribute('data-closed')){ // окно не свернуто
                msgImg.style.left = '240px';
                msgBlock.style.height = '';
                msgBlock.style.background = '';
                msgBlock.style.boxShadow = '';
                msgClosed.style.display = '';
                msgBlock.setAttribute('data-closed', '');
        }
    });
    //
    $(document).on('pjax:beforeSend', function () {
        // shtorka.style.display = 'none';
        // shtorka.classList.add('shtorka-animate'); // анимация в шапке
        document.body.style.cursor = 'progress';
        let target = $.pjax.options.container; // контейнер куда грузим AJAX данные
        let method = $.pjax.options.type;
        if(target == '#my-modal' && method == 'GET'){ // вызов модального окна(обратный звонок)
            $('#container').prepend('<div id="overlay"></div>');
            $('#overlay').show();
            $('#container_loading').show();
        }else if(method != 'POST') { // данные в блок #inc (основной контент)
            const inc = document.querySelector('#inc');
            const incOverl = document.querySelector('#inc-overlay');
            incOverl.style.width = inc.clientWidth + 'px';
            incOverl.style.height = inc.clientHeight + 'px';
            incOverl.style.left = inc.offsetLeft + 'px';
            incOverl.style.top = inc.offsetTop + 'px';
            scrollTo(0,0);

            $('#inc-overlay').css('display', 'block');
            $('#container_loading').show();
        }
    });

    $(document).on('pjax:complete', function () {
        document.body.style.cursor = 'default';
        $('#overlay').remove();
        $('#container_loading').hide();
        $('#inc-overlay').css('display', 'none');
        let method = $.pjax.options.type;
        if (method == 'POST' && $.pjax.options.url == '/'){ // очищаем поля формы отправки письма
            document.forms[0].reset();
        }
        // Ratelimiter сработал (ПРЕВЫШЕНО КОЛ-ВО ПОПЫТОК ВХОДА)
        // Куки сохранял в action site/login
        $(document).on('pjax:error', function(event, xhr, textStatus, errorThrown, options){
            if (xhr.status == 429){
                alert('Количество попыток исчерпано.Не более ' + readCookie('rateLimit') + ' попыток в минуту');
            }
        });
    });
};
