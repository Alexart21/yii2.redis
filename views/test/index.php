<?php

use yii\widgets\ActiveForm;
use app\models\Test;
use kartik\date\DatePicker;
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
<div><?= date('H') ?></div>
<?php
$H = date('H');
/*switch ($H)
{
    case:()
}*/
$H = 23;

$H = (int)$H;

if ($H >= 5 && $H <= 9){
    $msg = 'утра';
}elseif ($H > 9 && $H <= 17){
    $msg = 'дня';
}elseif ($H > 17 && $H < 22){
    $msg = 'вечера';
}else{
    $msg = 'времени суток';
}
?>
<div><?= $msg ?></div>
<?php
$model = new Test();
$form = ActiveForm::begin();
?>

<?=$form->field($model, 'from_date')->textInput()
    ->widget(DatePicker::classname(), [
        'name' => 'check_issue_date',
        'value' => date('d-M-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'todayHighlight' => true
        ]
]);?>

<?php
ActiveForm::end();
?>
<br>
<br>
<br>
<style>
    .fa-spin {
        -webkit-animation: fa-spin .5s infinite linear !important;
        animation: fa-spin .5s infinite linear !important;
    }
</style>
<div class="fa-3x">
    <i class="fas fa-spinner fa-spin"></i>
    <i class="fas fa-circle-notch fa-spin"></i>
    <i class="fas fa-sync fa-spin"></i>
    <i class="fas fa-cog fa-spin"></i>
    <i class="fas fa-spinner fa-pulse"></i>
    <i class="fas fa-stroopwafel fa-spin"></i>
</div>
