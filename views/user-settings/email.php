<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//var_dump(Yii::$app->user->identity->email);
//die;
?>
<div class="usr-set site-login">
    <p>Ваш текущий Email: <b><?= Yii::$app->user->identity->email ?></b></p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($emailFormModel, 'email', ['enableAjaxValidation' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>