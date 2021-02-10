<?php
//use Yii;
//var_dump(Yii::$app->backup->backupsFolder);die;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\FileHelper;

$this->title = 'Резервные копии файлов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    перечень архивируемых директорий в config/web
    <br>
    папка с резервными копиями <code><?= FileHelper::normalizePath(Yii::$app->backup->backupsFolder) ?></code>
    <br>
    <br>
    <p>
        <?= Html::a('Создать архив', ['create'], ['class' => 'btn btn-success']) ?>
        <br>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'file',
                    'format' => 'text',
                    'label' => 'Путь к архиву',
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data, $id) {
                        return Html::a('Скачать', \yii\helpers\Url::to(['file-backup/download', 'path' => $data['file']]), ['title' => 'Скачать', 'class' => 'btn btn-success']);
                    }
                ],
                [
                    'format' => 'raw',
                    //кнопку удаления выводим только если >1 дампа БД
                    'value' => function ($data, $id) {
                            return Html::a('Удалить', \yii\helpers\Url::to(['file-backup/delete', 'path' => $data['file']]), ['title' => 'Удалить', 'class' => 'btn btn-danger']);
                    }
                ],
            ],
        ]);
        ?>
</div>


