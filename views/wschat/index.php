<style>
    body{
        margin-left: 2em;
    }

    #msgs-content {
        display: flex;
        flex-direction: column-reverse;
        position: relative;
        width: 400px;
        height: 400px;
        padding: 1em;
        border: 1px solid blue;
        overflow-y: auto;
        margin-bottom: -20px;
    }

    #schat{
        position: relative;
        width: 400px;
        /*height: 400px;*/
        padding: 1em;
        padding-top: 2em;
        border: 1px solid blue;
        overflow-y: auto;
        margin-bottom: -20px;
    }

    .msg-line {
        position: relative;
        background: #eee;
        padding: .5em;
        border: 1px solid transparent;
        border-radius: 5px;
        margin-bottom: 40px;
    }

    .full-name {
        display: block;
        padding: 0 .5em;
        position: absolute;
        left: 0;
        top: -36px;
        /*background: #eee;
        border-top: 1px solid red;
        border-left: 1px solid red;
        border-right: 1px solid red;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;*/
    }

    #chatform-name, #msg {
        width: 300px;
        padding-left: 1em;
    }


    .control-label[for=msg]::after {
        content: '';
    }

    #chatform-name, #chatform-name:focus, #chatform-name:active {
        font-weight: bold;
        border: none !important;
        outline: none !important;
        border-left: 1px solid #222 !important;
        border-bottom: 1px solid #222 !important;
        background: transparent;
        border-bottom-left-radius: 5px !important;
        margin-bottom: -18px;
    }

    #msg {
        height: 60px;
        padding-right: 40px;
        /*border: none !important;*/
        outline: none !important;
        border: 1px solid #222;
    }

    .ip {
        font-size: 70%;
        font-weight: lighter;
    }

    .msg-line b {
        font-size: 140% !important;
    }

    button.fa-telegram-plane {
        font-size: 40px !important;
        background: transparent;
        display: block;
        position: absolute;
        bottom: 10px;
        left: 260px;
    }

    button.fa-telegram-plane:active, button.fa-telegram-plane:visited {
        border: none !important;
        outline: none !important;
    }

    .dt {
        display: block;
        text-align: right;
        font-size: 70%;
    }

    .dateOnly {
        font-size: 100% !important;
        /*color: hsl(60,100%,50%);*/
    }
    #msgsClear, #btnSetUsername, #saveChat{
        transform: scale(0.8);
    }

    #msgsClear, #saveChat{
        display: inline-block;
        margin-top: 1em;
    }

    #list li{
        font-weight: bold;
        cursor: pointer;
    }

    #schat > button{
        color: red !important;
        position: absolute;
        right: .5em;
        top: .5em;
    }
</style>

<h1>Web socket chat</h1>
<div class="d-flex flex-row justify-content-lg-start">
    <div>
        <div style="position: relative;">
            <div id="msgs-content"></div>
            <div style="text-align: right">
                <button id="msgsClear" type="button" class="btn btn-danger">Очистить</button>
                <button id="saveChat" class="btn btn-success">Сохранить чат</button>
            </div>
        </div>
        <br>
        <div id="response" style="color:#D00">Cоединения с сервером...</div>
        <input id="chatform-name" type="text" placeholder="Ваше имя" maxlength="30">
        <button id="btnSetUsername" class="btn btn-success">Установить</button>
        <br>
        <br>
        <input id="msg" type="text" placeholder="Сообщение" maxlength="1000">
        <div style="position: relative">
            <button id="chatBtn" type="submit" class="fab fa-telegram-plane"></button>
        </div>
        Отправка Ctrl + Enter<br>
        <label for="soundCheck">звук</label>
        <input id="soundCheck" type="checkbox" checked>


        <label for="dateCheck">Показывать время без даты</label>
        <input id="dateCheck" type="checkbox" checked>
    </div>

    <div id="storage" style="display: none">
        <h2>Есть сохраненные чаты:</h2>
        <ul id="list"></ul>
        <button id="delAll" class="btn btn-danger">удалить все</button>
        <div id="schat" style="display: none"></div>
    </div>
</div>
<script>
    window.onload = () => {
        $(function () {
            let chat = new WebSocket('ws://127.0.0.1:8080');
            let user_color = readCookie('user_color'),
                user_name = readCookie('user_name');
            if (user_name != 'undefined'){
                $('#chatform-name').val(user_name);
            }
            if(user_color != 'undefined'){
                updateColor();
            }
            chat.onmessage = function (e) {
                $('#response').text('');

                let response = JSON.parse(e.data);
                if (response.type && response.type == 'chat') {
                    let dt = new Date();
                    let currentDate = dt.getFullYear() + '-' + (parseInt(dt.getMonth()) + 1).toString() + '-' + dt.getDate();
                    let currentTime = dt.getHours() + ':' + dt.getMinutes() + ':' + dt.getSeconds();

                    $('#msgs-content').prepend('<p class="msg-line" style="border: .5px solid transparent"><span class="full-name"><b style="border-bottom: 2px solid hsl(' + response.user_color + ',100%,50%)">' + response.from + '</b></span><span class="msg-body">' + response.message + '</span><span class="dt"><span class="fa fa-check" style="font-size: 90%;color: green"></span><span class="dateOnly" style="display: none">' + currentDate + ' </span>' + currentTime + '</span></p>');
                    $('#msgs-content').scrollTop = $('#msgs-content').height;
                    $('.msg-body').replaceUrl();
                    document.cookie = 'user_color=' + response.user_color;
                    // console.log(response);
                    sound();
                } else if (response.message) {
                    $('#response').text(response.message);

                    if(response.type == 'set'){
                        /*document.cookie = 'user_color=' + response.user_color + '; path=/;  max-age=86400';
                        document.cookie = 'user_name=' + response.user_name + '; path=/;  max-age=86400';*/
                        document.cookie = 'user_color=' + response.user_color;
                        document.cookie = 'user_name=' + response.user_name;
                        updateColor();
                        console.log('here');
                    }

                }
            };
            chat.onopen = function (e) {
                $('#response').text('Установите имя');
            };
            let oldMsg = null;
            $('#chatBtn').click(function () {
                let msg = $('#msg').val();
                if (msg && (msg != oldMsg)) {
                    let user_color = readCookie('user_color');
                    chat.send(JSON.stringify({'action': 'chat', 'message': msg, 'user_color': user_color}));
                    // console.log(user_color);
                    oldMsg = msg;
                    $('#msg').val('');
                } else if (!msg) {
                    $('#response').text('Введите сообщение');
                    // alert('Введите сообщение')
                }else if(msg == oldMsg){
                    $('#response').text('Попытка повторной отправки. Измените текст сообщения');
                }
            })

            $('#btnSetUsername').click(function () {
                let username = document.getElementById('chatform-name').value;
                // console.log(username);
                if (username) {
                    chat.send(JSON.stringify({'action': 'setName', 'name': username}));
                    updateColor();
                } else {
                    alert('Установите имя')
                }
            })
        })
    }

    function updateColor() {
        let clr = decodeURIComponent(readCookie('user_color'));
        clr = 'hsl(' + clr + ',100%,50%)';
        // clr = 'hsl(10%,100%,50%)';
        if(clr){
            let inp = document.getElementById('chatform-name');
            // let msgBlock = document.querySelector('.msg-line');
            inp.style.color = clr;
            inp.setAttribute('style', '-webkit-text-fill-color:'  + clr + ' !important');
            chatBtn.style.color = clr;
            // msgBlock.style.border = '1px solid ' + clr;
        }
    }

    /* Очистить чат */
    msgsClear.addEventListener('click', ()=>{
        $('#msgs-content').text('');
    });

    /* Сохранить чат */
    saveChat.addEventListener('click', ()=>{
        let schat = document.querySelector('#msgs-content').innerHTML;
        if(schat.length > 0) {
            const dt = new Date();
            const name = prompt('имя для сохранения') + '_' + dt.getFullYear() + '-' + (parseInt(dt.getMonth()) + 1).toString() + '-' + dt.getDate();
            localStorage.setItem(name, schat);
        }
    });
    /* Сохраненные чаты */
    if(localStorage.length > 0){
        storage.style.display = 'block';
        let keys = Object.keys(localStorage);
        const list = document.getElementById('list');
        // выводим список сохраненных чатов
        for(let key of keys) {
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.innerText = key;
            a.setAttribute('data-chat', key);
            li.append(a);
            list.append(li);
        }
        // отображаем нужный чат
        // let chatLi = document.querySelector('#list');
        list.onclick = (e) => {
            let key = e.target.getAttribute('data-chat');
            schat.style.display = 'block';
            schat.innerHTML = localStorage.getItem(key) + '<button type="button" class="close"></button>';
            const close = document.querySelector('#schat > button');
            close.onclick = () => {
                schat.style.display = 'none';
            };
        };

        /* Удалить все сохраненные чаты */
        delAll.onclick = () => {
            localStorage.clear();
            list.innerHTML = '';
            storage.style.display = 'none';
        };
    }
</script>
