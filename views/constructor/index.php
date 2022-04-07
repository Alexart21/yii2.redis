<?php
$this->title = 'Онлайн дизайн чехлов';
?>
<noscript><strong>Для отображения страницы включите  Javascript !</strong></noscript>
<div id="app">Загрузка...</div>
<script>window.onload = () => {
        Coloris({
            el: '.coloris',
            alpha: false,
            swatches: [
                '#ffffff', //
                '#000000', //
                '#000080', //navy
                '#0000FF', //blue
                '#00FA9A', //MediumSpringGreen
                '#00FF00', //lime
                '#191970', //MidnightBlue
                '#4169E1', //RoyalBlue
                '#FF00FF', //Fuchsia
                '#FF0000', //red
                '#FFFF00', //Yellow
                '#FFFFE0', //LightYellow
            ]
        });
    }</script>