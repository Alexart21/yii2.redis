<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #w1-success{
        margin-top: 80px;
    }
</style>
<div class="user-index">
    <br>
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'role',
            [
                'attribute' => 'password_hash',
                'format' => 'raw',
                'value' => function($model)
                {
                    return $model->password_hash . '<a href="/alexadmx/user/setpass?id=' . $model->id . '" class="btn btn-danger" style="transform: scale(.8)">сменить пароль</a>';
                }
            ],
//            'auth_key',
            //'register_token:ntext',
            //'password_reset_token:ntext',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
