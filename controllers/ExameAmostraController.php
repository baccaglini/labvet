<?php

namespace app\controllers;

use Yii;
use app\models\ExameAmostra;
use app\models\ExameAmostraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExameAmostraController implements the CRUD actions for ExameAmostra model.
 */
class ExameAmostraController extends Controller
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
     * Lists all ExameAmostra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExameAmostraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExameAmostra model.
     * @param integer $exame
     * @param integer $amostra
     * @return mixed
     */
    public function actionView($exame, $amostra)
    {
        return $this->render('view', [
            'model' => $this->findModel($exame, $amostra),
        ]);
    }

    /**
     * Creates a new ExameAmostra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExameAmostra();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'exame' => $model->exame, 'amostra' => $model->amostra]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExameAmostra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $exame
     * @param integer $amostra
     * @return mixed
     */
    public function actionUpdate($exame, $amostra)
    {
        $model = $this->findModel($exame, $amostra);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'exame' => $model->exame, 'amostra' => $model->amostra]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ExameAmostra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $exame
     * @param integer $amostra
     * @return mixed
     */
    public function actionDelete($exame, $amostra)
    {
        $this->findModel($exame, $amostra)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExameAmostra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $exame
     * @param integer $amostra
     * @return ExameAmostra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($exame, $amostra)
    {
        if (($model = ExameAmostra::findOne(['exame' => $exame, 'amostra' => $amostra])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
