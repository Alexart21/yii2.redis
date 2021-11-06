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
    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            [
                'attribute' => 'body',
                'format' => 'raw',
                'value' => function($model)
                {
                    if (strlen($model->body) > 50){
                        $res = substr($model->body, 0, 50) . ' ...<br>' . '<a class="btn btn-secondary" href="/alexadmx/post/view?id=' . $model->id . '">читать дальше</a>';
                    }else{
                        $res = $model->body;
                    }
                    return $res;
                }
            ],
//            'date',
            [
                'attribute' => 'date',
                'format' => ['datetime', 'php:d M Y H:i:s'],
            ],
            /*[
                'attribute' => 'date',
                'format' => 'date',
            ],*/
            [
               'attribute' => 'is_read',
                'format' => 'raw',
                'value' => function($model)
                {
                    if($model->is_read == 0){
                        $btn = '<b style="color:green">новое</b>';
                    }else{
                        $btn = '<span style="color:grey">обработано</span>';
                    }

                    return $btn;
                }
            ],
            [
               'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Действия',
            ],
        ],
    ]); ?>
</div>
<script>
    // выделяем цветом непрочитанные письма и делаем кликабельными
    /*let td = document.getElementsByTagName('td');
    for (i = 0; i < td.length; i++){
        if (td[i].innerText == '0'){
            let id = td[i].parentNode.firstChild.nextSibling.textContent;
            let tr = td[i].parentElement;
            tr.style.background = '#fff';
            tr.style.border = '2px solid #00ff00';
            td[i].style.background = '#7eff91';
            td[i].style.cursor = 'pointer';
            let t = td[i];
            td[i].addEventListener('click', function () { // по клику делаем прочитанным
                read(id, 'post', tr, t);
            });
        }
    }*/
    // хрень чтобы добавить значок "лупы" в поле input
    /*const xx = document.querySelectorAll('input');
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
    }*/
</script>
