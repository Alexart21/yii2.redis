<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  class="site-login container" style="max-width: 600px">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

            <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                ]);
            ?>
            <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'placeholder' => 'Имя'])->label(false) ?>
            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['placeholder' => 'email'])->label(false) ?>
            <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'пароль'])->label(false) ?>
            <?= $form->field($model, 'password_repeat', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'пароль еще раз'])->label(false) ?>

            <?/*= $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                [
                    'siteKey' => '6LftVL4ZAAAAAPQq_Sj_9_6Cyguka6qMJpDJRyWs', // unnecessary is reCaptcha component was set up
                ]
            )  */?>

            <? /*= \himiklab\yii2\recaptcha\ReCaptcha3::widget([
                'name' => 'reCaptcha',
                'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
                'action' => 'signup',
            ]) */ ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
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