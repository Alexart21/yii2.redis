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
        <ol id="list"></ol>
        <button id="delAll" class="btn btn-danger">удалить все</button>
        <div id="schat" style="display: none"></div>
    </div>
</div>
<script>
    function readCookie(name) {
        const matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    //
    window.onload = () => {
        $(function () {
            let chat = new WebSocket('ws://localhost:8080/wschat');
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
                    // дата вида 06.03.2021
                    let currentDate = dt.toLocaleDateString();
                    // время без секунд вида 07:48
                    let currentTime = dt.toLocaleTimeString().slice(0,-3);
                    
                    $('#msgs-content').prepend('<p class="msg-line" style="border: .5px solid transparent"><span class="full-name"><b style="border-bottom: 2px solid hsl(' + response.user_color + ',100%,50%)">' + response.from + '</b></span><span class="msg-body">' + response.message + '</span><span class="dt"><span class="fa fa-check" style="font-size: 90%;color: green"></span><span class="dateOnly" style="display: none">' + currentDate + ' </span>' + currentTime + '</span></p>');
                    $('#msgs-content').scrollTop = $('#msgs-content').height;
                    $('.msg-body').replaceUrl();
                    document.cookie = 'user_color=' + response.user_color;
                    console.log(dt.toLocaleDateString());
                    console.log(dt.toLocaleTimeString());
                    console.log(dt.toLocaleTimeString().slice(0,-3));
                    sound();
                } else if (response.message) {
                    $('#response').text(response.message);

                    if(response.type == 'set'){
                        /*document.cookie = 'user_color=' + response.user_color + '; path=/;  max-age=86400';
                        document.cookie = 'user_name=' + response.user_name + '; path=/;  max-age=86400';*/
                        document.cookie = 'user_color=' + response.user_color;
                        document.cookie = 'user_name=' + response.user_name;
                        updateColor();
                        // console.log('here');
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
        const all = localStorage.getItem('wschats');
        let wschats;
        if(all){
          wschats = JSON.parse(all)
        }else{
            wschats = [];
        }
        const data = document.querySelector('#msgs-content').innerHTML;
        if(data.length > 0) {
            const dt = new Date();
            const name = prompt('имя для сохранения') + '_' + dt.getFullYear() + '-' + (parseInt(dt.getMonth()) + 1).toString() + '-' + dt.getDate();
            const chat = {};
            chat.name = name;
            chat.data = data;
            wschats.push(chat)
            localStorage.setItem('wschats', JSON.stringify(wschats));
        }
    });
    /* Сохраненные чаты */
    let allChats = localStorage.getItem('wschats');
    if(allChats){
        allChats = JSON.parse(allChats);
        storage.style.display = 'block';
        // let keys = Object.keys(localStorage);
        const list = document.getElementById('list');
        // выводим список сохраненных чатов
        allChats.forEach((item) => {
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.innerText = item.name;
            a.setAttribute('data-chat', item.name);
            li.append(a);
            list.append(li);
        })
        // отображаем нужный чат
        // let chatLi = document.querySelector('#list');
        list.onclick = (e) => {
            let key = e.target.getAttribute('data-chat');
            schat.style.display = 'block';
            // console.log(allChats)
            let chatData;
            allChats.forEach((item) => {
                if(item.name === key){
                    chatData = item.data;
                }
            })
            schat.innerHTML = chatData + '<button type="button" class="close"></button>';
            const close = document.querySelector('#schat > button');
            close.onclick = () => {
                schat.style.display = 'none';
            };
        };

        /* Удалить все сохраненные чаты */
        delAll.onclick = () => {
            localStorage.removeItem('wschats');
            list.innerHTML = '';
            storage.style.display = 'none';
        };
    }
</script>
