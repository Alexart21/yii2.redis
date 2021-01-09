<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Входящие письма';
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;
?>
<style>
    .glyphicon.glyphicon-pencil {
        display: none;
    }
</style>
<div class="post-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (!empty($session->get('allPostCount'))) :
    ?>
    <a class="btn btn-danger" href="/alexadmx/post/del_all">Удалить все</a>
    <?php
    endif;
    ?>
    <?php
    if (!empty($session->get('newPostCount'))) :
    ?>
    <a href="/alexadmx/post/postlabel" class="btn btn-dark">Пометить все прочитанными</a>
    <?php
    endif;
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'email:email',
            'tel',
            'body:ntext',
            'date',
            'is_read',
            [
               'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
</div>
<script>
    // выделяем цветом непрочитанные письма и делаем кликабельными
    let td = document.getElementsByTagName('td');
    for (i = 0; i < td.length; i++){
        if (td[i].innerText == '0'){
            let id = td[i].parentNode.firstChild.nextSibling.textContent;
            let tr = td[i].parentElement;
            tr.style.background = '#fff';
            tr.style.border = '2px solid #00ff00';
            // tr.style.cursor = 'pointer';
            /*tr.addEventListener('click', function () {
                window.location.replace('/alexadmx/post/view?id=' + id);
            });*/
            td[i].style.background = '#7eff91';
            td[i].style.cursor = 'pointer';
            let t = td[i];
            td[i].addEventListener('click', function () { // по клику делаем прочитанным
                read(id, 'post', tr, t);
            });
        }
    }
    // хрень чтобы добавить значок "лупы" в поле input
    const xx = document.querySelectorAll('input');
    for (let i=0; i<xx.length; i++){
        xx[i].parentNode.style.position = 'relative';
        let s = document.createElement('span');
        s.setAttribute('class', 'fa fa-search');
        s.style.position = 'absolute';
        s.style.right = '20px';
        s.style.top = '22px';
        xx[i].parentNode.appendChild(s);
        //
        xx[i].addEventListener('mouseover', function () {
            s.style.visibility = 'hidden';
        });
        xx[i].addEventListener('mouseout', function () {
            s.style.visibility = 'visible';
        });
    }
</script>
