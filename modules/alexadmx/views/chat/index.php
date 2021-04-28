<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\WschatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'WebSocket chat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <a href="/alexadmx/default/chat-clear" class="btn btn-danger">Удалить все</a>
    <button id="chatBtn" class="btn btn-success">Показать / скрыть чат</button>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'text',
            'ip',
            'created_at',
            //'color',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <iframe id="chatFrame" src="" style="display: none;position: absolute;top:80px;right:0;width: 500px;height: 800px;float: right" frameborder="0"></iframe>
</div>
<script>
    chatBtn.addEventListener('click', () => {
        if(chatFrame.style.display == 'none') {
            chatFrame.style.display = 'block';
            chatFrame.src = '/wschat'
        }else {
            chatFrame.style.display = 'none';
            chatFrame.src = ''
        }
    })
</script>

