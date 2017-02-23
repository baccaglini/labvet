<?php

namespace app\controllers;

use Yii;
use app\models\AtendimentoExame;
use app\models\AtendimentoExameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AtendimentoExameController implements the CRUD actions for AtendimentoExame model.
 */
class AtendimentoExameController extends Controller
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
     * Lists all AtendimentoExame models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AtendimentoExameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AtendimentoExame model.
     * @param integer $atendimento
     * @param integer $exame
     * @return mixed
     */
    public function actionView($atendimento, $exame)
    {
        return $this->render('view', [
            'model' => $this->findModel($atendimento, $exame),
        ]);
    }

    /**
     * Creates a new AtendimentoExame model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AtendimentoExame();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'atendimento' => $model->atendimento, 'exame' => $model->exame]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AtendimentoExame model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $atendimento
     * @param integer $exame
     * @return mixed
     */
    public function actionUpdate($atendimento, $exame)
    {
        $model = $this->findModel($atendimento, $exame);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'atendimento' => $model->atendimento, 'exame' => $model->exame]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AtendimentoExame model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $atendimento
     * @param integer $exame
     * @return mixed
     */
    public function actionDelete($atendimento, $exame)
    {
        $this->findModel($atendimento, $exame)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AtendimentoExame model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $atendimento
     * @param integer $exame
     * @return AtendimentoExame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($atendimento, $exame)
    {
        if (($model = AtendimentoExame::findOne(['atendimento' => $atendimento, 'exame' => $exame])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
