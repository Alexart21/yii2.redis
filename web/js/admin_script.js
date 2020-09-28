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
/**/

/* AJAX */
// отправка контента в режиме редактирования contenteditable
// content объект с данными {content': 'ghjgjjj'}
function form_call(content, id) {
    $.ajax({
        type: 'POST',
        url: '/alexadmx/content/update?id=' + id + '&contenteditable=1',
        data: content,
        success: function (res) {
            // alert(res);
            $('#result').html(res);
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        },
        cache: false,
        beforeSend: function () {
            loading();
        },
        complete: function () {
            loading_stop();
            $('#result').css('display', 'block');
            $('body,html').animate({scrollTop: 0}, 400);
        }
    });
}
// анимация загрузки
function loading() {
    document.body.style.cursor = 'progress';
}
// стоп анимации
function loading_stop() {
    document.body.style.cursor = "";
}

function msg_count(table) {
    let el = document.getElementById(table);
    let count = el.innerText * 1;
    count = count - 1;
    if (count <= 0) {
        count = '';
    }
    el.innerText = count;
    // el.style.color = 'red';
}

function read(id, table, tr, td) {
    $.ajax({
        type: 'POST',
        url: '/alexadmx/' + table + '/read?id=' + id,
        // data: content,
        success: function (res) {
            msg_count(table);
            tr.style.background = '';
            tr.style.border = '';
            td.style.background = '';
            td.style.cursor = '';
            td.innerText = '1';
            // console.log(td);
            alert(res);
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseText);
        },
        cache: false,
        beforeSend: function () {
            loading();
        },
        complete: function () {
            loading_stop();
        }
    });
}