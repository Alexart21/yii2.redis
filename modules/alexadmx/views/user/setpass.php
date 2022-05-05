<?php
//die('HERE');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Установка пароля';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<br>
<h3><?= $this->title . ' для пользователя ' . '<span class="text-primary underline">' . $user->username . '</span>' ?></h3>
<div class="pass" style="max-width: 600px">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye\"></span><div>{error}</div></div>",])->textInput(['autofocus' => true, 'placeholder' => 'новый пароль', 'class' => 'pass-field'])->label(false) ?>
    <?= $form->field($model, 'password_repeat', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye\"></span><div>{error}</div></div>",])->textInput(['placeholder' => 'повторите пароль', 'class' => 'pass-field'])->label(false) ?>
    <div style="display: inline-block">
        <button type="button" class="btn btn-light" onclick="generatePass()">сгенерировать</button>&nbsp;&nbsp;
        кол-во символов&nbsp;&nbsp;<input id="len" type="number" min="6" max="256" value="12" style="width: 3em !important;">
    </div>
    <br>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Установить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    // Переключение видимости символов пароля и иконки
    const icon = document.querySelectorAll('.fa');
    let inp = [];
    for (let i = 0; i < icon.length; i++) {
        icon[i].addEventListener('click', (e) => {
            inp[i] = icon[i].previousElementSibling;
            if (icon[i].classList.contains('fa-eye-slash')) {
                icon[i].classList.remove('fa-eye-slash');
                icon[i].classList.add('fa-eye');
                inp[i].setAttribute('type', 'text');
            } else {
                icon[i].classList.remove('fa-eye');
                icon[i].classList.add('fa-eye-slash');
                inp[i].setAttribute('type', 'password');
            }
        });
    }
    //
    function strRand(len) { // случайная строка
        let result = '';
        let words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM@#$%&';
        let max_position = words.length - 1;
        for (let i = 0; i < len; ++i) {
            let position = Math.floor(Math.random() * max_position);
            result = result + words.substring(position, position + 1);
        }
        return result;
    }
    function generatePass(){
        const len = document.getElementById('len').value;
        // console.log(len);
        const str = strRand(len);
        const fields = document.querySelectorAll('.pass-field');
        // console.log(fields);
        let i = 0;
        while (fields[i]){
            fields[i].value = str;
            i++;
        }
    }
</script>
