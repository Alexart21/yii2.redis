<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
    #msgs-content{
        position: relative;
        width: 300px;
        height: 400px;
        padding: 1em;
        border: 1px solid blue;
        overflow-y: auto;
        margin-bottom: -20px;
    }

    #chatform-name, #msg{
        width: 300px;
    }

    .control-label[for=msg]::after {
        content: '';
    }

    #chatform-name, #chatform-name:focus, #chatform-name:active{
        font-weight: bold;
        border: none !important;
        outline: none !important;
        border-left: 1px solid #222;
        border-bottom: 1px solid #222;
        background: transparent;
        border-bottom-left-radius: 20px;
        margin-bottom: -18px;
    }

    #msg{
        height: 60px;
        padding-right: 40px;
        /*border: none !important;*/
        outline: none !important;
        border: 1px solid #222;
    }

    .ip{
        font-size: 70%;
        font-weight: lighter;
    }

    .msg-line b{
        font-size: 120%;
    }

    button.fa-telegram-plane{
        font-size: 40px;
        background: transparent;
        display: block;
        position: absolute;
        bottom: -50px;
        left: 260px;
    }
</style>
<div style="position: relative;">
        <div id="msgs-content">
            <?= $res ?>
        </div>
    <?php Pjax::begin([
        'clientOptions' => [
            'method' => 'POST',
            'url' => '/chat',
            'container' => '#msgs-content',
            'formSelector' => '#chat-form',
        ],
        'enablePushState' => false, // не обновлять url
        'formSelector' => '#chat-form',
        'timeout' => '10000',
    ]);
    ?>
    <?php $form = ActiveForm::begin([
        'id' => 'chat-form',
        'options' => [
            'data-pjax' => true,
        ],
    ]);
    ?>

    <?= $form->field($chatForm, 'name')->textInput(['value' => $name, 'autofocus' => true, 'placeholder' => 'Имя', 'tabindex' => 1])->label(null) ?>

    <div style="position: relative">
        <button form="chat-form" id="chatBtn" type="submit" class="fab fa-telegram-plane"></button>
    </div>
    <?= $form->field($chatForm, 'text', ['template' =>"{input}\n{label}\n{hint}\n{error}",])->textarea([
        'id' => 'msg',
        'placeholder' => 'Текст',
        'required' => true,
        'tabindex' => 2,
    ])->label('Отправка Ctrl + Enter') ?>

    <label for="soundCheck">звук</label>
    <input id="soundCheck" type="checkbox" checked>

    <?php ActiveForm::end(); ?>
    <!-- submit button впихнул выше -->
    <?php Pjax::end(); ?>
</div>

