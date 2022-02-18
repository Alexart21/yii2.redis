window.onload = () => {
    const dragableImg = document.getElementById('img2');
    const container = document.getElementById('img-container');
    const exportBtn = document.getElementById('export-btn');
    const clearBtn = document.getElementById('clear-btn');
    const rotateBtn = document.getElementById('rotate-btn');
    const fileBtn = document.getElementById('file-btn');
    const scaleBtn = document.getElementById('scale-btn');
    const wInput = document.getElementById('width');
    const hInput = document.getElementById('height');
    const rotation = 0;
    // инпуты ширины/высоты
    wInput.value = dragableImg.clientWidth;
    hInput.value = dragableImg.clientHeight;
    // соотношения сторон картинки
    const ratio = dragableImg.clientWidth / dragableImg.clientHeight;
    // сохраняем пропорции
    wInput.addEventListener('change', () =>{
       hInput.value = Math.floor(wInput.value / ratio);
       $('#scale-btn').tooltip('show');
    })
    //
    hInput.addEventListener('change', () =>{
        wInput.value = Math.floor(hInput.value * ratio);
        $('#scale-btn').tooltip('show');
    })
    //
    document.getElementById('rotate').addEventListener('change', () => {
        $('#rotate').tooltip('show');
    })
    setTimeout(() =>{ // чтобы не прыгала картинка при позиционировании
        dragableImg.style.visibility = 'visible';
    }, 100);
    /* Если есть ранее сохраненные трансформации то применяем */
    if(localStorage.getItem('x')){ // Мы уже ранее чето делали с картинкой
        dragableImg.style.left = localStorage.getItem('x') + 'px';
        dragableImg.style.top = localStorage.getItem('y') + 'px';
    }else {// зашли впервые и позиционируем картинку в левый верхний угол
        dragableImg.style.left = container.offsetLeft + 'px';
        dragableImg.style.top = container.offsetTop + 'px';
        // clear(dragableImg, container);
    }
    if(localStorage.getItem('rotation')){
        dragableImg.style.transform = 'rotate(' + localStorage.getItem('rotation') + ' deg)';
        // dragableImg.src = localStorage.getItem('src');
    }else{
        dragableImg.style.transform = 'rotate(0)';
    }
    if(localStorage.getItem('src')){
        dragableImg.src = localStorage.getItem('src');
    }else{
        // dragableImg.src = localStorage.getItem('src');
    }


    /* Вешаем события на кнопи */
    clearBtn.addEventListener('click', () => {
        clear(dragableImg, container);
    });
    //
    rotateBtn.addEventListener('click', () => {
        rotate(dragableImg);
    });
    //
    scaleBtn.addEventListener('click', (elem) => {
        scaleImg(dragableImg, wInput, hInput)
    });
    //
    fileBtn.addEventListener('click', () => {
        clear(dragableImg, container);
    });
    //
    exportBtn.addEventListener('click', () => {
        // убираем бордеры иначе с ними будет скриншот
        dragableImg.style.border = 0;
        container.style.border = 0;
        exportImg(container);
    });
    //* ограничения, за которые нельзя вытащить dragableImg
    let limits = {
        top: container.offsetTop,
        right: container.offsetWidth + container.offsetLeft - dragableImg.offsetWidth,
        bottom: container.offsetHeight + container.offsetTop - dragableImg.offsetHeight,
        left: container.offsetLeft
    };
    // позиционируем перетаскиваемую картинку не давая вылезти за пределы родителя
    dragableImg.addEventListener('dragend', (e) => {
        let x,y;
        // console.log(e.pageX);
        // console.log(e.pageY);
        if(e.pageX < limits.left){
            x = limits.left;
        }else if(e.pageX > limits.right){
            x = limits.right;
        }else {
            x = e.pageX;
        }

        if(e.pageY < limits.top){
            y = limits.top;
        }else if(e.pageY > limits.bottom){
            y = limits.bottom;
        }else{
            y = e.pageY;
        }
        dragableImg.style.left = x + 'px';
        dragableImg.style.top = y + 'px';
        // сохраняем новые координаты в localstorage
        localStorage.setItem('x', x);
        localStorage.setItem('y', y);
    });
}
/* Сохраняем как png файл */
function exportImg(elem){
    html2canvas(elem, {
    }).then(function(canvas) {
        canvas.toBlob(function(blob) {
            // после того, как Blob создан, загружаем его
            let link = document.createElement('a');
            link.download = str_rand(12) + '.png';
            link.href = URL.createObjectURL(blob);
            link.click();
            // удаляем внутреннюю ссылку на Blob чтоб не висела впамяти
            URL.revokeObjectURL(link.href);
        }, 'image/png');
        // перезагружаемся
        location.reload();
    });
}
/* Масштабирование картинки */
function scaleImg(elem, wInput, hInput){
    // создаём <canvas> того же размера
    let canvas = document.createElement('canvas');
    let w = wInput.value;
    let h = hInput.value;
    canvas.width = w;
    canvas.height = h;
    let ctx = canvas.getContext('2d');
    ctx.drawImage(elem, 0, 0, w, h);
    ctx.canvas.toBlob(function(blob) {
        const file = new File([blob],'result.png', {
            type: 'image/png',
            lastModified: Date.now()
        });
        reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            // console.log(reader.result);
            elem.src = reader.result;
            // сохраняем на будущее
            localStorage.setItem('src', reader.result);
        };
    }, 'image/png', 1);

}
/* Возвращаем в девственное состояние */
function clear(dragablElem, container){
    localStorage.clear();
    dragablElem.style.left = container.offsetLeft + 'px';
    dragablElem.style.top = container.offsetTop + 'px';
    dragablElem.style.transform = 'rotate(0)';
    dragablElem.src = '/img/test/img2.png';
    container.style.backgroundImage = '/img/test/img1.png';
}
/* крутим картинку */
function rotate(elem){
    let rotation = document.querySelector('#rotate').value;
    elem.style.transform = 'rotate(' + rotation + 'deg)';
    localStorage.setItem('rotation', rotation);
    // console.log(deg);
}
/* Генерация псевдослучайной строки */
function str_rand(len) {
    let result       = '';
    let words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    let max_position = words.length - 1;
    for( i = 0; i < len; ++i ) {
        position = Math.floor ( Math.random() * max_position );
        result = result + words.substring(position, position + 1);
    }
    return result;
}
//
function showDragImg(elem){
    elem.style.visibility = 'visible';
}