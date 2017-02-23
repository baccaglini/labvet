<?php

namespace app\controllers;

use Yii;
use app\models\ClinicaFone;
use app\models\ClinicaFoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClinicaFoneController implements the CRUD actions for ClinicaFone model.
 */
class ClinicaFoneController extends Controller
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
     * Lists all ClinicaFone models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClinicaFoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClinicaFone model.
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
     * Creates a new ClinicaFone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClinicaFone();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClinicaFone model.
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
     * Deletes an existing ClinicaFone model.
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
     * Finds the ClinicaFone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $clinica
     * @param integer $sequencia
     * @return ClinicaFone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($clinica, $sequencia)
    {
        if (($model = ClinicaFone::findOne(['clinica' => $clinica, 'sequencia' => $sequencia])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
