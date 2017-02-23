<?php

namespace app\controllers;

use app\models\ProprietarioAnimal;
use app\models\ProprietarioAnimalSearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProprietarioAnimalController implements the CRUD actions for ProprietarioAnimal model.
 */
class ProprietarioAnimalController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all ProprietarioAnimal models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProprietarioAnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProprietarioAnimal model.
     * @param integer $proprietario
     * @param integer $sequencia
     * @return mixed
     */
    public function actionView($proprietario, $sequencia) {
        return $this->render('view', [
                    'model' => $this->findModel($proprietario, $sequencia),
        ]);
    }

    /**
     * Creates a new ProprietarioAnimal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProprietarioAnimal();
        $msg = '';
        $post = Yii::$app->request->post();

        if ($post) {
            try {
                $model->load($post);
                $model->ativo = 1;

                /** PEGA A SEQUENCIA */
                $seq = $model->find()->where(['proprietario' => $model->proprietario])->max('sequencia');
                $model->sequencia = $seq + 1;
                $dataAux = $model->nascimento;
                $arrDataAux = explode("/", $dataAux);
                $model->nascimento = $arrDataAux[2] . '-'. $arrDataAux[1] . '-'. $arrDataAux[0];
                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados...');
                }

                return $this->redirect(['index']);
            } catch (\Exception $exc) {
                $msg = $exc->getMessage() . '<br />' . $exc->getTraceAsString();
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing ProprietarioAnimal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $proprietario
     * @param integer $sequencia
     * @return mixed
     */
    public function actionUpdate($proprietario, $sequencia) {
        $model = $this->findModel($proprietario, $sequencia);
        $msg = '';

        $post = Yii::$app->request->post();
        if ($post) {
            try {
                $model->load($post);
                $dataAux = $model->nascimento;
                $arrDataAux = explode("/", $dataAux);
                $model->nascimento = $arrDataAux[2] . '-'. $arrDataAux[1] . '-'. $arrDataAux[0];
                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados...');
                }
                return $this->redirect(['index']);
            } catch (\Exception $exc) {
                $msg = $exc->getMessage() . '<br />' . $exc->getTraceAsString();
            }
        }
        $model->nascimento = Yii::$app->formatter->asDate($model->nascimento, 'php:d/m/Y');
        return $this->render('update', [
                    'model' => $model,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing ProprietarioAnimal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $proprietario
     * @param integer $sequencia
     * @return mixed
     */
    public function actionDelete($proprietario, $sequencia) {
        //$this->findModel($proprietario, $sequencia)->delete();
        $model = $this->findModel($proprietario, $sequencia);
        $model->ativo = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProprietarioAnimal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $proprietario
     * @param integer $sequencia
     * @return ProprietarioAnimal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($proprietario, $sequencia) {
        if (($model = ProprietarioAnimal::findOne(['proprietario' => $proprietario, 'sequencia' => $sequencia])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLista_options() {
        $post = Yii::$app->request->post();
        $id = $post['depdrop_parents'];
        $count = ProprietarioAnimal::find()->where(['ativo' => 1, 'proprietario' => $id])->count();
        $lst = ProprietarioAnimal::find()->where(['ativo' => 1, 'proprietario' => $id])->orderBy('animal')->all();

        $htmlResp = array();

        if ($count > 0) {
            foreach ($lst as $valor) {
                $htmlResp[] = ['id' => $valor->sequencia, 'name' => $valor->animal];
            }
        }
        echo Json::encode(['output' => $htmlResp, 'selected' => '']);
        return;
    }

}
