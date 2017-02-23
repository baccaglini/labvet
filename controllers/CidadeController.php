<?php

namespace app\controllers;

use Yii;
use app\models\Cidade;
use app\models\CidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CidadeController implements the CRUD actions for Cidade model.
 */
class CidadeController extends Controller {

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
     * Lists all Cidade models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cidade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Cidade();
        $msg = '';
        $post = Yii::$app->request->post();
        if ($post) {
            try {
                $model->load($post);
                $model->flAtivo = 1;
                if (!$model->save()) {
                    throw new Exception('Erro ao cadastrar Cidade.');
                }
                return $this->redirect(['index']);
            } catch (\Exception $exc) {
                $msg = $exc->getMessage();
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Cidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cidade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->flAtivo = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Cidade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLista_options() {
        $post = Yii::$app->request->post();
        $id_estado = $post['depdrop_parents'];
        $countCidades = Cidade::find()->where(['flAtivo' => 1, 'idEstado' => $id_estado])->count();
        $lstCidades = Cidade::find()->where(['flAtivo' => 1, 'idEstado' => $id_estado])->orderBy('prioridade desc, nmCidades')->all();

        $htmlResp = array();

        if ($countCidades > 0) {
            foreach ($lstCidades as $cidade) {
                $htmlResp[] = ['id' => $cidade->id, 'name' => $cidade->nmCidades];
            }
        }
        echo \yii\helpers\Json::encode(['output' => $htmlResp, 'selected' => '']);
        return;
    }

}
