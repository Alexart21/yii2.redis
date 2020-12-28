<?php
//die('HERE');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Установка пароля для пользователя ' . $user->username;
//$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<br>
<h2><?= $this->title ?></h2>
<div style="max-width: 600px">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'новый пароль'])->label(false) ?>
    <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'повторите пароль'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
