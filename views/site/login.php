<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Modal;

$this->title = 'Вход в админку';
//$this->params['breadcrumbs'][] = $this->title;
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

    <?= $form->field($model, 'username', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-user\"></span><div>{error}</div></div>",])->textInput(['placeholder' => 'Логин']) ?>
    <br/>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'Пароль']) ?>

    <?/*= $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha2::className(),
        [
            'siteKey' => '6LftVL4ZAAAAAPQq_Sj_9_6Cyguka6qMJpDJRyWs', // unnecessary is reCaptcha component was set up
        ]
    )  */?>

    <? /*= \himiklab\yii2\recaptcha\ReCaptcha3::widget([
        'name' => 'reCaptcha',
        'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
        'action' => 'login',
    ]) */ ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"squaredTwo\">{input} {label}<span id =\"labelText\">Запомнить на " . Yii::$app->params['rememberMeDay'] . " дней</span></div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>
    <div class="form-group">
<!--        <div class="col-lg-offset-1 col-lg-11">-->
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
<!--        </div>-->
    </div>
    <?php ActiveForm::end(); ?>
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
        // Чекбокс
        const check = document.querySelector('input[type=checkbox]');
        // console.log(check);

        const label = document.getElementById('labelText');
        console.log(label);

        check.addEventListener('click', function () {
            // check.setAttribute('checked', 'true')
            console.log(check.getAttribute('value'));
        })
    }

</script>
