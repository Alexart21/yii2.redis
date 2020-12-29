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
<h3><?= $this->title .  ' для пользователя ' . '<span class="text-primary underline">' . $user->username . '</span>' ?></h3>
<div class="pass" style="max-width: 600px">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['autofocus' => true, 'placeholder' => 'новый пароль'])->label(false) ?>
    <?= $form->field($model, 'password_repeat', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'повторите пароль'])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Установить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    window.onload = function(){
        // Переключение видимости символов пароля и иконки
        const icon = document.querySelectorAll('.fa');
        let inp = [];
        // console.log(icon);
        for(let i=0; i<icon.length; i++){
            icon[i].addEventListener('click', (e)=>{
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

    };
</script>
