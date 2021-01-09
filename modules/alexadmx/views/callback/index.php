<?php

use yii\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\callbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на обратный звонок';
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;
?>
<style>
    .glyphicon.glyphicon-pencil{
        display: none;
    }
</style>
<div class="callback-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (!empty($session->get('allCallCount'))) :
    ?>
    <a class="btn btn-danger" style="" href="/alexadmx/callback/del_all">Удалить все</a>
    <?php
    endif;
    ?>
    <?php
    if (!empty($session->get('newCallCount'))) :
        ?>
     <a href="/alexadmx/callback/zvonoklabel" class="btn btn-dark">Пометить все прочитанными</a>
    <?php
        endif;
    ?>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'tel',
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
    let td = document.getElementsByTagName('td');
    for (i = 0; i < td.length; i++){
        if (td[i].innerText == '0'){
            let id = td[i].parentNode.firstChild.nextSibling.textContent;
            let tr = td[i].parentElement;
            tr.style.background = '#fff';
            tr.style.border = '2px solid #00ff00';
            // tr.style.cursor = 'pointer';
            /*tr.addEventListener('click', function () {
                window.location.replace('/alexadmx/callback/view?id=' + id);
            });*/
            //
            td[i].style.background = '#7eff91';
            td[i].style.cursor = 'pointer';
            let t = td[i];
            td[i].addEventListener('click', function () {
                read(id, 'callback', tr, t);
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
