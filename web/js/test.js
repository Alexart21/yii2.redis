window.onload = () => {
    const dragableImg = document.getElementById('img2');
    const container = document.getElementById('img-container');
    const exportBtn = document.getElementById('export-btn');
    const clearBtn = document.getElementById('clear-btn');
    const rotateBtn = document.getElementById('rotate-btn');
    const scaleBtn = document.getElementById('scale-btn');
    const wInput = document.getElementById('width');
    const hInput = document.getElementById('height');
    const checkboks = document.getElementById('zoom');
    const rotation = 0;
    let limits;

    /* Если есть ранее сохраненные трансформации то применяем */
    if (localStorage.getItem('bg')) {
        container.style.backgroundImage = 'url("' + localStorage.getItem('bg') + '")';
    }else{
        container.style.backgroundImage = 'url("/img/test/img1.png")';
    }
    if (localStorage.getItem('x')) {
        dragableImg.style.left = localStorage.getItem('x') + 'px';
        dragableImg.style.top = localStorage.getItem('y') + 'px';
    } else {// зашли впервые и позиционируем картинку в левый верхний угол
        dragableImg.style.left = container.offsetLeft + 'px';
        dragableImg.style.top = container.offsetTop + 'px';
        // clear(dragableImg, container);
    }
    if (localStorage.getItem('rotation')) {
        dragableImg.style.transform = 'rotate(' + localStorage.getItem('rotation') + 'deg)';
        // dragableImg.src = localStorage.getItem('src');
    } else {
        dragableImg.style.transform = 'rotate(0)';
    }
    if (localStorage.getItem('src')) {
        dragableImg.src = localStorage.getItem('src');
    } else {
        dragableImg.src = "/img/test/img2.png";
    }
    if (localStorage.getItem('w')) {
        const w = localStorage.getItem('w');
        const h = localStorage.getItem('h');
        // инпуты ширины/высоты
        wInput.value = w;
        hInput.value = h;
    }else{
        wInput.value = dragableImg.clientWidth;
        hInput.value = dragableImg.clientHeight;
    }


    // соотношения сторон картинки
    const ratio = dragableImg.clientWidth / dragableImg.clientHeight;
    // сохраняем пропорции
    wInput.addEventListener('change', () => {
        if (checkboks.checked) {
            hInput.value = Math.floor(wInput.value / ratio);
            $('#scale-btn').tooltip('show');
        }
    })
    //
    hInput.addEventListener('change', () => {
        if (checkboks.checked) {
            wInput.value = Math.floor(hInput.value * ratio);
            $('#scale-btn').tooltip('show');
        }
    })
    //
    document.getElementById('rotate').addEventListener('change', () => {
        $('#rotate').tooltip('show');
    })
    setTimeout(() => { // чтобы не прыгала картинка при позиционировании
        dragableImg.style.visibility = 'visible';
    }, 100);

    /* Вешаем события на кнопи */
    clearBtn.addEventListener('click', () => {
        clear(dragableImg, container);
    });
    rotateBtn.addEventListener('click', () => {
        rotate(dragableImg);
    });
    scaleBtn.addEventListener('click', (elem) => {
        scaleImg(dragableImg, wInput, hInput)
    });
    exportBtn.addEventListener('click', () => {
        // убираем бордеры иначе с ними будет скриншот
        dragableImg.style.border = 0;
        container.style.border = 0;
        exportImg(container);
    });

    //* ограничения, за которые нельзя вытащить dragableImg
    limits = {
        top: container.offsetTop,
        right: container.offsetWidth + container.offsetLeft - dragableImg.offsetWidth,
        bottom: container.offsetHeight + container.offsetTop - dragableImg.offsetHeight,
        left: container.offsetLeft
    };
    if(localStorage.getItem('w')){ // после изменения размеров картинки прежние значения уже не подходят ставим другие
        limits.right = container.offsetWidth + container.offsetLeft - localStorage.getItem('w');
        limits.bottom = container.offsetHeight + container.offsetTop - localStorage.getItem('h');
    }

    // позиционируем перетаскиваемую картинку не давая вылезти за пределы родителя
    dragableImg.addEventListener('dragend', (e) => {
        let x, y;
        // console.log(e.pageX);
        // console.log(e.pageY);
        if (e.pageX < limits.left) {
            x = limits.left;
        } else if (e.pageX > limits.right) {
            x = limits.right;
        } else {
            x = e.pageX;
        }

        if (e.pageY < limits.top) {
            y = limits.top;
        } else if (e.pageY > limits.bottom) {
            y = limits.bottom;
        } else {
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
function exportImg(elem) {
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
        // перезагружаемся
        location.reload();
    });
}

/* Масштабирование картинки */
function scaleImg(elem, wInput, hInput) {
    // создаём <canvas> того же размера
    let canvas = document.createElement('canvas');
    let w = wInput.value;
    let h = hInput.value;
    canvas.width = w;
    canvas.height = h;
    let ctx = canvas.getContext('2d');
    ctx.drawImage(elem, 0, 0, w, h);
    ctx.canvas.toBlob(function (blob) {
        const file = new File([blob], 'result.png', {
            type: 'image/png',
            lastModified: Date.now()
        });
        reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            elem.src = reader.result;
            elem.style.width = w + 'px';
            elem.style.height = h + 'px';
            // сохраняем на будущее
            localStorage.setItem('src', reader.result);
            localStorage.setItem('w', w);
            localStorage.setItem('h', h);
        };
    }, 'image/png', 1);
    // перезагружаемся
    location.reload();
}

/* Возвращаем в девственное состояние */
function clear(dragablElem, container) {
    localStorage.clear();
    dragablElem.style.left = container.offsetLeft + 'px';
    dragablElem.style.top = container.offsetTop + 'px';
    dragablElem.style.transform = 'rotate(0)';
    dragablElem.src = '/img/test/img2.png';
    container.style.backgroundImage = '/img/test/img1.png';
    document.getElementById('width').value = dragablElem.width;
    document.getElementById('height').value = dragablElem.height;
    // перезагружаемся
    location.reload();
}

/* крутим картинку */
function rotate(elem) {
    let rotation = document.querySelector('#rotate').value;
    elem.style.transform = 'rotate(' + rotation + 'deg)';
    localStorage.setItem('rotation', rotation);
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
    fileInput.onchange = () =>{
        let file = fileInput.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            let bgImg = reader.result;
            document.getElementById('img-container').style.backgroundImage = 'url("' + bgImg + '")';
            localStorage.setItem('bg', bgImg);
        };
    }
});
/**********************************************/
/*DRAG DROP Взял откудато с codepen.io */
/* Работает не трогаю */
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
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

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
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

}