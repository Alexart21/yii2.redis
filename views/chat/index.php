<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .control-label[for=msg]::after {
        content: '';
    }

    #chatform-name{
        font-weight: bold;
    }
</style>
<div>
    <div id="msgsDialog">
        <div id="msgs-content" style="width: 300px;height: 100px;border: 1px solid blue;overflow-y: scroll">
            <?= $res ?>
        </div>
    </div>
    <br>
    <br>
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
//            'action' => '/chat','
            'data-pjax' => true,
        ],
    ]);
    ?>

    <?= $form->field($chatForm, 'name')->textInput(['value' => $name, 'style' => 'color:' . $color])->label(null) ?>

    <?= $form->field($chatForm, 'text')->textarea([
        'id' => 'msg',
        'placeholder' => 'Type here...',
        'required' => true,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['id' => 'sub', 'class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
<script>
    // let f = document.querySelector('#chat-form')
    // let name = document.querySelector('input');
    let text = document.querySelector('textarea');

    text.onkeydown = function( e ) {
        if ( e.keyCode === 13 && e.ctrlKey ){
            document.getElementById('sub').click();
        }
    };

</script>

