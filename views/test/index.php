<?php
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<style>
    #logo{
        width: 200px;
        height: 100px;
        border: 1px solid #000;
    }

    .logo-displ{
        display: none;
    }
</style>
<div id="logo" class="logo-vis"></div>
<button id="left-togle">click</button>

<script>

    const lbt = document.getElementById('left-togle');
    lbt.onclick = function () {
        const logo = document.getElementById('logo');
        logo.classList.toggle('logo-displ');
    }
</script>
<div style="font-size: 400%"><span class="fa fa-ruble-sign"></span><span class="fab fa-docker" style="font-size: 100px"></span>
    <span class="fa fa-key"></span>
</div>

<?php
use yii\bootstrap4\Alert;
?>
<?php
Alert::begin([
        'options' => [
                'class' => 'alert-warning',
        ]
]);
?>
<h1>TEST</h1>
<?php
Alert::end();
?>
<?php Pjax::begin() ?>
<?php if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php
$form = ActiveForm::begin([
        'options' => [
                'enctype' => 'multipart/form-data',
//                'data-pjax' => true,
        ]
]);
//var_dump($form);die;
?>
<fieldset>
<?=$form->field($model, 'date')->textInput()
    ->widget(DatePicker::class, [
        'name' => 'check_issue_date',
        'value' => date('d-M-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату'],
        'pluginOptions' => [
            'format' => 'd-M-yyyy',
            'todayHighlight' => true
        ]
]);?>
    <?=$form->field($model,'avatar')->fileInput()  ?>
    <?=$form->field($model,'test')->textInput()  ?>
</fieldset>
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
<?php
ActiveForm::end();
?>
<?php Pjax::end() ?>
<br>
<hr>