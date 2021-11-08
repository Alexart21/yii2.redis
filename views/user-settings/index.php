<?php
//die('HERE');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
//var_dump(Yii::$app->user->id);
//die;
$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usr-set site-login">

    <?php $form = ActiveForm::begin(); ?>
    <!--    <fieldset>-->
    <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput() ?>
    <?php
    $imgLink = $model->avatar_path ? '/upload/users/usr' . $model->id . '/img/' . $model->avatar_path : '/upload/default_avatar/no-image.png';
    ?>
    <!--        <h3>Аватар </h3>-->
    <img src="<?= $imgLink ?>" alt="" style="max-width: 150px;height: auto">
    <?php
    if ($model->avatar_path) :
        ?>
        <br>
        <a href="/user-settings/delete-avatar" class="btn-set"  data-method="post">удалить аватар</a><br>
    <?php
    endif;
    ?>
    <!--    --><? //= $form->field($model,'avatar')->fileInput(['class' => 'dropzone'])  ?>
    <br>
    <div class="drop-zone">
        <span class="drop-zone__prompt"><span class="fa fa-cloud-upload-alt"></span><br>Кликните или перетащите файл<br><b>(jpg,tif,png,gif)</b></span>
        <?= $form->field($model, 'avatar')->fileInput(['class' => 'drop-zone__input'])->label(false) ?>
    </div>
    <br>
    <?= Html::submitButton('Отправить', ['class' => 'btn success-button']) ?>
    <!--    </fieldset>-->
    <?php ActiveForm::end(); ?>
    <hr class="auth-hr">
    <a href="/user-settings/email" class="btn-set">Изменить Email</a>
    <br>
    <a href="/user-settings/pass" class="btn-set">Изменить пароль</a>
    <br>
    <a id="close" class="btn-set" href="/user-settings/close" data-method="post">Закрыть аккаунт</a>
    <br>
    <br>
</div>