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
            [
                'attribute' => 'is_read',
                'format' => 'raw',
                'value' => function($model)
                {
                    if($model->is_read == 0){
                        $btn = '<b style="color:green;font-size: 110%">новое</b>';
                    }else{
                        $btn = '<span style="color:grey">обработано</span>';
                    }

                    return $btn;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
</div>