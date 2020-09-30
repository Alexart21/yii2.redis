<?php

namespace app\modules\alexadmx\controllers;

use app\modules\alexadmx\models\Msg;
use Yii;
use app\modules\alexadmx\models\CallbackSearch;
use app\models\Callback;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CallbackController implements the CRUD actions for Callback model.
 */
class CallbackController extends AppAlexadmxController
{
    /*public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest){
            throw new NotFoundHttpException('страница не найдена');
        }
        return parent::beforeAction($action);
    }*/

    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Callback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Callback model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Deletes an existing Callback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Callback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Callback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Callback::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDel_all() // Очистка всей табли `callback`
    {
        $res = Yii::$app->db->createCommand()->truncateTable('callback')->execute();
        if ($res == 0) {
            return $this->redirect('/alexadmx/callback');
        }
    }

    /* Помечаем все заказы обратных звонков как прочитанные */
    public function actionZvonoklabel()
    {
        Msg::setZvonokAllRead();
        unset($_SESSION['newCallCount']);
        return $this->redirect('/alexadmx/callback');
    }


    /* Помечаем запись как прочитанную */
    // Обрати внимание результат возвращается без view
    // Показываем кастомным алертом успех/ошибка
    public function actionRead($id)
    {
        if (Yii::$app->request->isAjax) {
            $id = (int)$id;
            $model = $this->findModel($id);
            $model->is_read = 1;
            $res = $model->save();

            $res = $res ? '<h3 style="color: green">Помечено прочитанным</h3><script>setTimeout(\'alert_close()\', 2000)</script>' : '<h3 style="color: red">Сбой!</h3>';
            return $res;
        }
    }
}
