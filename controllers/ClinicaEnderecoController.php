<?php

namespace app\controllers;

use Yii;
use app\models\ClinicaEndereco;
use app\models\ClinicaEnderecoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClinicaEnderecoController implements the CRUD actions for ClinicaEndereco model.
 */
class ClinicaEnderecoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                //'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ClinicaEndereco models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClinicaEnderecoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClinicaEndereco model.
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
     * Creates a new ClinicaEndereco model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClinicaEndereco();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClinicaEndereco model.
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
     * Deletes an existing ClinicaEndereco model.
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
     * Finds the ClinicaEndereco model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $clinica
     * @param integer $sequencia
     * @return ClinicaEndereco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($clinica, $sequencia)
    {
        if (($model = ClinicaEndereco::findOne(['clinica' => $clinica, 'sequencia' => $sequencia])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
