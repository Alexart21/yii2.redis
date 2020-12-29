<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<table style="transform: scale(0.8)">
    <tr>
        <td colspan="2"><h3 class="text-center">Описание некоторых полей</h3></td>
    </tr>
    <tr>
        <td>
            <table class="role-table">
                <tr>
                    <th colspan="3"><h4 class="text-center"> Поле "role"</h4></th>
                </tr>
                <tr>
                    <th>значение</th>
                    <th>10</th>
                    <th>20</th>
                </tr>
                <tr>
                    <th>привелегии</th>
                    <td>пользователь</td>
                    <td>администратор</td>
                </tr>
            </table>
        </td>

        <td>
            <table class="role-table">
                <tr>
                    <th colspan="2"><h4 class="text-center">Поле "status"</h4></th>
                </tr>
                <tr>
                    <th>10</th>
                    <th>1</th>
                </tr>
                <tr>
                    <td>активный</td>
                    <td>не прошел подтверждение регистрации</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
    label{
        font-weight: bold;
        display: block;
    }
</style>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>
<!--    --><?//= $form->field($model, 'password_hash')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
