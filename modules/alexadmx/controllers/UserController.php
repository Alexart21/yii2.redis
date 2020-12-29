<?php

namespace app\modules\alexadmx\controllers;

use app\modules\alexadmx\models\UnregisterUserSearch;
use Yii;
use app\models\User;
use app\modules\alexadmx\models\SetPassForm;
use app\modules\alexadmx\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AppAlexadmxController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionUpdateStatus($id)
    {
        $id = (int)$id;
        $user = User::findOne(['id' => $id]);
        $user->status = User::STATUS_ACTIVE;
        if ($user->save()) {
            Yii::$app->session->setFlash('success', 'Для ' . $user->username . ' установлен статус STATUS_ACTIVE=' . User::STATUS_ACTIVE);
        }else{
            Yii::$app->session->setFlash('error', 'Произошла ошибка при запросе.');
        }
        return $this->redirect('/alexadmx/user/unregister?UserSearch[status]=1');
    }

    /* Установка пароля */
    public function actionSetpass($id)
    {
        $id = (int)$id;
        // не путайся 2 модели тут
        $user = User::findOne(['id' => $id]);
        $model = new SetPassForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $user->setPassword($model->password);
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Установлен пароль для ' . $user->username);
            }else{
                Yii::$app->session->setFlash('error', 'Произошла ошибка при запросе.');
            }

            return $this->redirect('/alexadmx/user/view?id=' . $user->id);
        }

        return $this->render('setpass', compact('user', 'model'));
    }

    /* Пользователи не подтвердившие регистрацию */
    public function actionUnregister()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('unregister', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
