<?php
//var_dump($path);die;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Тестовое задание';
// картинка по умолчанию
if(!$img_src){
    $img_src = '/img/test/img2.png';
}
// фон
if(!$bg_src){
    $bg_src = '/img/test/img1.png';
}
?>
<main class="container">
    <h1>Тестовое задание</h1>
    <h3>Перетащите внутреннюю картинку в пределах красной рамки</h3>
    <div id="img-container" style='background-image: url("<?= $bg_src ?>")'>
<!--        <img src="/img/test/img1.png" alt="" id="img2">-->
        <img src="<?= $img_src ?>" alt="" id="img2" draggable="true">
    </div>
    <br>
    <br>
    <h5>Размер картинки</h5>
    ширина
    <input id="width" type="number" >
    высота
    <input id="height" type="number">
    <button id="scale-btn" class="btn btn-secondary" title="не забудь нажать" data-toggle="tooltip" data-trigger="manual">Применить</button>
    <br>
    <h5>Поворот в градусах по часовой<br>(можно отрицательные значения)</h5>
    <input id="rotate" type="number" value="90">
    <button id="rotate-btn" class="btn btn-secondary" title="не забудь нажать" data-toggle="tooltip" data-trigger="manual">применить</button><br><br>
    <button id="clear-btn" class="btn btn-danger">Сброс</button>

    <button id="export-btn" class="btn btn-success">Скачать результат</button>
</main>
<hr>
<h2>Смена картинок(только *.png,  синхронно)</h2>
<?php
$form = ActiveForm::begin();
?>
<?= $form->field($model, 'background_img')->fileInput() ?>
<?= $form->field($model, 'drag_img')->fileInput() ?>
<div class="form-group" style="margin-left: 1em">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'id' => 'file-btn']) ?>
</div>
<?php
ActiveForm::end();
?>
<hr>
асинхронно еще не сделал...
<h5>Ссылка на github: <a href="https://github.com/Alexart21/yii2.redis" target="_blank">https://github.com/Alexart21/yii2.redis</a></h5>
<h5>Подробнее в файле README.md на GitHub</h5>
