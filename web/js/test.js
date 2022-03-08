window.onload = () => {
    //overlay
    let imgOver = document.querySelector('.img-block-over');
    if (!localStorage.getItem('src')) {
        imgOver.style.height = document.querySelector('.img-control').clientHeight + 'px';
    }
    //
    const dragableImg = document.getElementById('img2');
    const container = document.getElementById('img-container');
    const exportBtn = document.getElementById('export-btn');
    const clearBtn = document.getElementById('clear-btn');
    let resizeContainer = document.querySelector('.resize-container');
    const imgBlock = document.querySelector('.img-control');
    const mainBlock = document.querySelector('.main-block');
    const contenteditable = document.getElementById('contenteditable');

    /* Если есть ранее сохраненные трансформации то применяем */
    if (localStorage.getItem('bg')) {
        container.style.backgroundImage = 'url("' + localStorage.getItem('bg') + '")';
    } else {
        container.style.backgroundImage = 'url("/img/test/img1.png")';
    }

    if (localStorage.getItem('inText')) {
        contenteditable.style.left = localStorage.getItem('textX') + 'px';
        contenteditable.style.top = localStorage.getItem('textY') + 'px';
        contenteditable.style.fontSize = localStorage.getItem('fontSize') + 'px';
        contenteditable.style.fontFamily = localStorage.getItem('font');
        contenteditable.style.color = localStorage.getItem('color');
        contenteditable.style.letterSpacing = localStorage.getItem('letSps') + 'px';
        contenteditable.innerText = localStorage.getItem('inText');
        /*Вставляем и в инпуты*/
        innerText.value = localStorage.getItem('inText');
        font.value = localStorage.getItem('font');
        fontSize.value = localStorage.getItem('fontSize');
        color.value = localStorage.getItem('color');
        letSps.value = localStorage.getItem('letSps');
    }

    if (localStorage.getItem('src')) {
        dragableImg.src = localStorage.getItem('src');
        resizeableImage($('.resize-image'));
        imgBlock.style.display = 'block';
        mainBlock.style.display = 'block';
    } else {
        // dragableImg.src = '/img/test/no-image.png';
    }

    if (localStorage.getItem('x')) {
        if (!resizeContainer) {
            resizeContainer = document.querySelector('.resize-container');
        }
        resizeContainer.style.left = localStorage.getItem('x') + 'px';
        resizeContainer.style.top = localStorage.getItem('y') + 'px';
    } else {// зашли впервые и позиционируем картинку в левый верхний угол

    }

    if (localStorage.getItem('transform')) {
        dragableImg.style.transform = localStorage.getItem('transform');
    }

    /* Вешаем события на кнопи */
    clearBtn.addEventListener('click', () => {
        clear(dragableImg, container);
    });
    /* Нажали сохранить */
    exportBtn.addEventListener('click', () => {
        // проверка зафиксили ли текст
        let text = document.querySelector('.contenteditable').innerText;
        if (text) {
            let next = confirm('Вы редатировали текст.Зафиксировать его перед скриншотом? (отмена - продолжить редактирование)');
            if (!next) return;
            fixText(contenteditable, container);
        }
        // убираем те элементы которы не должны быть на скриншоте
        // document.querySelector('.resize-img').style.border = 'none';
        if (document.querySelector('.btn-block')) {
            document.querySelector('.btn-block').style.display = 'none';
        }
        if (document.querySelector('.resize-handle-ne')) {
            document.querySelector('.resize-handle-ne').style.display = 'none';
            document.querySelector('.resize-handle-se').style.display = 'none';
            document.querySelector('.resize-handle-nw').style.display = 'none';
            document.querySelector('.resize-handle-sw').style.display = 'none';
        }


        // сохраняем позицию внутренней картинки
        resizeContainer = document.querySelector('.resize-container');
        if (resizeContainer) {
            let box = resizeContainer.getBoundingClientRect();
            let x = box.left + pageXOffset - container.offsetLeft;
            let y = box.top + pageYOffset - container.offsetTop;
            if (x <= 1) x = 0;
            if (y <= 1) y = 0;
            localStorage.setItem('x', x);
            localStorage.setItem('y', y);
        }
        // передаем то что скриншотим и внутр. каринку
        exportImg(container, dragableImg);
    });

    //* Реализация поворота input type=range */
    $(function () {
        let slider = $('input.image-rotate'),
            image = $('#img2');
        slider.on('change mousemove', function () {
            image.css('transform', 'rotate(' + $(this).val() + 'deg)')
        });
    })
}

/* Сохраняем как png файл */
function exportImg(elem, innerImg) {
    html2canvas(elem, {}).then(function (canvas) {
        canvas.toBlob(function (blob) {
            // после того, как Blob создан, загружаем его
            let link = document.createElement('a');
            link.download = str_rand(12) + '.png';
            link.href = URL.createObjectURL(blob);
            link.click();
            // удаляем внутреннюю ссылку на Blob чтоб не висела впамяти
            URL.revokeObjectURL(link.href);
        }, 'image/png');
        // здесь сохраняем внутреннюю картинку если мы ее не масштабировали то обычный src иначе base64
        localStorage.setItem('src', innerImg.src);
        // console.log(innerImg.style.transform);
        if (innerImg.style.transform) { // если только вертели картинку
            // console.log(innerImg.style.transform);
            localStorage.setItem('transform', innerImg.style.transform);
        }
        // перезагружаемся
        location.reload();
    });
}

/* Возвращаем в девственное состояние */
function clear(dragablElem, container) {
    localStorage.clear();
    // перезагружаемся
    location.reload();
}

/* Генерация псевдослучайной строки */
function str_rand(len) {
    let result = '';
    let words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    let max_position = words.length - 1;
    for (i = 0; i < len; ++i) {
        position = Math.floor(Math.random() * max_position);
        result = result + words.substring(position, position + 1);
    }
    return result;
}

//
function showDragImg(elem) {
    elem.style.visibility = 'visible';
}

// получить расширение файла
function getFileExt(fname) {
    return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
}

/* Form Fetch() */
document.addEventListener('DOMContentLoaded', () => {
    //
    const form = document.querySelector('#bg-form');
    const fileInput = document.getElementById('file-input');
    /* Здесь отпрака на сервер */
    /*form.onsubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        console.log(formData.get('background_img'));
        let response = await fetch('/test', {
            method: 'POST',
            body: formData,
        });
        let result = await response.text();
        if(response.ok){

        }
    }*/
    /* Здесь никуда не отправляем */
    fileInput.onchange = () => {
        let file = fileInput.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            let bgImg = reader.result;
            document.getElementById('img-container').style.backgroundImage = 'url("' + bgImg + '")';
            localStorage.setItem('bg', bgImg);
        };
    }
});

/////
function readFile(input, img) {
    let file = input.files[0];
    if (getFileExt(file.name) != 'png') {
        alert('Ата-та, только PNG');
        return;
    }
    let container = document.querySelector(img);
    let reader = new FileReader();
    reader.readAsDataURL(file)
    reader.onload = function () {
        // console.log(reader.result);
        container.src = reader.result;
        resizeableImage($('.resize-image')); // init плагина
        // document.querySelector('.img-control').style.display = 'block';
        // document.querySelector('.main-block').style.display = 'block';
    };
    reader.onerror = function () {
        console.log(reader.error);
    };

}

function imgAdd(elem) {
    document.querySelector('.img-block-over').style.display = 'none';
    elem.click();
}

function allAdd() {
    let buttons = document.querySelectorAll('.rBt');
    let i = 0;
    while (buttons[i]) {
        if (i == 0) {
            buttons[i].classList.toggle('visible-left');
        } else {
            buttons[i].classList.toggle('visible-right');
        }
        i++;
    }
}

function textAdd(area) {
    document.getElementById('contenteditable').style.display = 'block';
    // area.style.display = 'inlineBlock';
    // resizeableImage($('#contenteditable')); // init плагина
}

/* Драг дроп блока с текстом */
contenteditable.onmousedown = function (event) {

    let shiftX = event.clientX - contenteditable.getBoundingClientRect().left;
    let shiftY = event.clientY - contenteditable.getBoundingClientRect().top;

    // contenteditable.style.position = 'absolute';
    // contenteditable.style.zIndex = 1000;
    document.body.append(contenteditable);

    moveAt(event.pageX, event.pageY);

    // переносит блок на координаты (pageX, pageY),
    // дополнительно учитывая изначальный сдвиг относительно указателя мыши
    function moveAt(pageX, pageY) {
        contenteditable.style.left = pageX - shiftX + 'px';
        contenteditable.style.top = pageY - shiftY + 'px';
    }

    function onMouseMove(event) {
        moveAt(event.pageX, event.pageY);
    }

    // передвигаем блок при событии mousemove
    document.addEventListener('mousemove', onMouseMove);

    // отпустить блок, удалить ненужные обработчики
    contenteditable.onmouseup = function (e) {
        document.removeEventListener('mousemove', onMouseMove);
        contenteditable.onmouseup = null;

        /*let container = document.getElementById('img-container');
        let end = confirm('Зафиксировать текстовый слой? (отмена - продолжить редактирование)');
        if (end) { // создаем клон блока с текстом а прежний убиваем
            fixText(contenteditable, container);
            localStorage.setItem('textFixed', 1);
        }*/
    };

};

contenteditable.ondragstart = function () {
    return false;
}
/**/

/* Убиваем текстовый контейнер.И на его место копию.После драгдропа не берется скриншот !!!!!!!!!!!!!!! */
function fixText(textContainer, mainContainer) {
    let x = textContainer.offsetLeft - mainContainer.offsetLeft;
    let y = textContainer.offsetTop - mainContainer.offsetTop;
    let inText = textContainer.innerText;
    let font = document.getElementById('font').value;
    let fontSize = document.getElementById('fontSize').value;
    let color = document.getElementById('color').value;
    let letSps = document.getElementById('letSps').value;
    // удаляем
    textContainer.parentNode.removeChild(textContainer);
    // делаем клона
    let div = document.createElement('div');
    div.className = "contenteditable";
    div.setAttribute('id', 'res');
    div.innerText = inText;
    mainContainer.appendChild(div);
    res.style.left = x + 'px';
    res.style.top = y + 'px';
    res.style.fontFamily = font;
    res.style.fontSize = fontSize + 'px';
    res.style.color = color;
    res.style.letterSpacing = letSps + 'px';
    // сохраняем
    localStorage.setItem('textX', x);
    localStorage.setItem('textY', y);
    localStorage.setItem('inText', inText);
    localStorage.setItem('font', font);
    localStorage.setItem('fontSize', fontSize);
    localStorage.setItem('color', color);
    localStorage.setItem('letSps', letSps);
}

// control
innerText.addEventListener('input', () => {
    contenteditable.innerText = innerText.value;
});

fontSize.addEventListener('input', () => {
    contenteditable.style.fontSize = fontSize.value + 'px';
});

font.addEventListener('change', () => {
    contenteditable.style.fontFamily = font.value;
});

color.addEventListener('change', () => {
    contenteditable.style.color = color.value;
});

letSps.addEventListener('input', () => {
    console.log('here');
    contenteditable.style.letterSpacing = letSps.value + 'px';
});


/**********************************************/
/*DRAG DROP Взял откудато с codepen.io */
/* Работает не трогаю */
/*document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    });
});

/!**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 *!/
function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
            let img = reader.result;
            thumbnailElement.style.backgroundImage = `url('${img}')`;
            let fileExt = getFileExt(file.name); // расширение файла
            // допустимые расширения
            let res = ['png', 'PNG'].indexOf(fileExt);
            if (res < 0) {
                alert('Недопустимый тип файла !');
                return;
            }
            // такой финт ушами чтобы узнать реальные размеры Base64 изображения
            const tmpImg = new Image();
            tmpImg.src = img;
            tmpImg.onload = function() {
                const imgWidth = tmpImg.naturalWidth;
                const imgHeight = tmpImg.naturalHeight;
                const newImg = document.getElementById('img2');
                newImg.src = img; //
                newImg.style.width = imgWidth + 'px';
                newImg.style.height = imgHeight + 'px';
                // вставляем в инпуты ширины/высоты
                document.getElementById('width').value = imgWidth;
                document.getElementById('height').value = imgHeight;
                // сохраняем
                localStorage.setItem('src', img);
                localStorage.setItem('w', imgWidth);
                localStorage.setItem('h', imgHeight);
                location.reload();
            };
        };
    } else {
        thumbnailElement.style.backgroundImage = null;
    }

}*/
/////////////
