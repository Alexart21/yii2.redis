<?php
//die('HERE');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
//var_dump(Yii::$app->user->id);
//die;
?>
<div class="usr-set site-login">

    <?php $form = ActiveForm::begin(); ?>
    <fieldset>
    <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput() ?>
    <?php
    $imgLink = $model->avatar_path ? '/upload/users/usr' . $model->id . '/img/' .$model->avatar_path  : '/upload/default_avatar/no-image.png';
    ?>
<!--        <h3>Аватар </h3>-->
    <img src="<?= $imgLink ?>" alt="" style="max-width: 150px;height: auto">
        <?php
        if($model->avatar_path) :
        ?>
            <br><a href="/user-settings/delete-avatar">удалить аватар</a><br>
        <?php
        endif;
        ?>
<!--    --><?//= $form->field($model,'avatar')->fileInput(['class' => 'dropzone'])  ?>

        <div class="drop-zone">
            <span class="drop-zone__prompt"><span class="fa fa-cloud-download-alt"></span><br>Кликните или перетащите файл<br><b>(jpg,tif,png,gif)</b></span>
            <?= $form->field($model,'avatar')->fileInput(['class' => 'drop-zone__input'])->label(false)  ?>
        </div>
        <br>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </fieldset>
        <?php ActiveForm::end(); ?>
    <a href="/user-settings/email">Изменить Email</a>
    <br>
    <a href="/user-settings/pass">Изменить пароль</a>
    <br>
    <a id="close" href="/user-settings/close"  data-confirm="Эту операцию нельзя отменить. Вы уверены?">закрыть аккаунт</a>
    <br>
</div>