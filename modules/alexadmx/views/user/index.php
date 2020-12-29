<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Все пользователи');
$this->params['breadcrumbs'][] = $this->title;

//$model = $dataProvider->getModels(); // пока не понял откуда приходит $model
//var_dump($model);
?>
<style>
    #w1-success{
        margin-top: 80px;
    }
</style>
    <br>
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить пользователя'), ['create'], ['class' => 'btn btn-success']) ?>
        <a href="/alexadmx/user/unregister?UserSearch[status]=<?= User::STATUS_REQUEST ?>">Пользователи не подтвердившие регистрацию</a>
    </p>
<?php
//var_dump($dataProvider);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'role',
            'status',
//            'auth_key',
            //'register_token:ntext',
            //'password_reset_token:ntext',
            [
                'attribute' => 'created_at',
                'value' => function($model)
                {
                    return date('Y-m-d H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model)
                {
                    return date('Y-m-d H:i:s', $model->updated_at);
                }
            ],
            [
                'attribute' => 'password',
                'format' => 'raw',
                'value' => function($model)
                {
                    return '<a href="/alexadmx/user/setpass?id=' . $model->id . '" class="btn btn-warning" style="transform: scale(.8);text-wrap: none">изменить пароль</a>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
