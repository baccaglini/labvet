<?php

namespace app\controllers;

use Yii;
use app\models\ClinicaEmail;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClinicaEmailController implements the CRUD actions for ClinicaEmail model.
 */
class ClinicaEmailController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ClinicaEmail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClinicaEmail::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClinicaEmail model.
     * @param integer $clinica
     * @param integer $sequencia
     * @return mixed
     */
    public function actionView($clinica, $sequencia)
    {
        return $this->render('view', [
            'model' => $this->findModel($clinica, $sequencia),
        ]);
    }

    /**
     * Creates a new ClinicaEmail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClinicaEmail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClinicaEmail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $clinica
     * @param integer $sequencia
     * @return mixed
     */
    public function actionUpdate($clinica, $sequencia)
    {
        $model = $this->findModel($clinica, $sequencia);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ClinicaEmail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $clinica
     * @param integer $sequencia
     * @return mixed
     */
    public function actionDelete($clinica, $sequencia)
    {
        $this->findModel($clinica, $sequencia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClinicaEmail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $clinica
     * @param integer $sequencia
     * @return ClinicaEmail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($clinica, $sequencia)
    {
        if (($model = ClinicaEmail::findOne(['clinica' => $clinica, 'sequencia' => $sequencia])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
