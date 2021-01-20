<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Modal;

$this->title = 'Вход';
// Здесь пароль меняй (в поле password_hash)
//echo Yii::$app->getSecurity()->generatePasswordHash('password');
//die;
?>
<?php
Modal::begin([
        'id' => 'login',
    'options' => [
            // что бы не закрывалось по клику вне окна
            'data-backdrop' => 'false',
        'data-keyboard' => 'false'
    ]
]);
?>
<div class="site-login container">
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php
    // здесь вставить  реальный пароль
    // в базу поставить сгенеренный хеш и рабочий логин
    // закоментировать echo
    //    echo Yii::$app->getSecurity()->generatePasswordHash('password')
    ?>
<!--    <h3>Введите данные для входа:</h3>-->
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

    <?= $form->field($model, 'login_or_email', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-user\"></span><div>{error}</div></div>",])->textInput(['placeholder' => 'Имя или E-mail']) ?>
    <br/>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'Пароль']) ?>

    <?= $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha2::class,
        [
            'siteKey' => '6LfRBQEaAAAAAEqEbZSrlYH0sQz5Q-bX58GHPNjL', // unnecessary is reCaptcha component was set up
        ]
    )  ?>

    <? /*= \himiklab\yii2\recaptcha\ReCaptcha3::widget([
        'name' => 'reCaptcha',
        'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
        'action' => 'login',
    ]) */ ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"squaredTwo\">{input} {label}<span id =\"labelText\">Запомнить на " . Yii::$app->params['rememberMeDay'] . " дней</span></div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>
    <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
<!--        <button title="очистить форму" class="login-reset" type="reset" style="float: right;border: none;background: #fff"><span style="font-size: 80%">очистить</span></button>-->
    </div>
    <a href="/signup" style="display: block;float: right">зарегистрироваться</a>
    <?php ActiveForm::end(); ?>
</div>
<br>
<br>
<div>
    <b>Забыли пароль? Тогда Вам  <?= Html::a('сюда', ['user/request-password-reset']) ?>.</b>
</div>
<?php
Modal::end();
?>
<script>
    window.onload = function(){
        $('#login').modal();
        $('.modal-content').velocity('transition.bounceIn');
        // Переключение видимости символов пароля и иконки
        const inp = document.getElementById('loginform-password');
        let icon = inp.nextElementSibling;
        icon.addEventListener('click', function () {
            if (icon.classList.contains('fa-eye-slash')) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }

            if (inp.getAttribute('type') == 'password') {
                inp.setAttribute('type', 'text');
            } else {
                inp.setAttribute('type', 'password');
            }
        });
    };
</script>
