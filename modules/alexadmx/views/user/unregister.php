<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пользователи не подтвердившие регистрацию');
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
<h3><?= Html::encode($this->title) ?></h3>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function($model)
            {
                return $model->status . '<br><a href="/alexadmx/user/update-status?id=' . $model->id . '" class="btn btn-success" style="transform: scale(.8);text-wrap: none">изменить статус</a>';
            }

        ],
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
