<?php

namespace app\controllers;

use app\models\Raca;
use app\models\RacaSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RacaController implements the CRUD actions for Raca model.
 */
class RacaController extends Controller {

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
     * Lists all Raca models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RacaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Raca model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Raca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Raca();
        $msg = '';
        $post = Yii::$app->request->post();
        if ($post) {
            try {
                $model->load($post);
                $model->ativo = 1;
                if (!$model->save()) {
                    throw new Exception('Erro ao cadastrar Raça.');
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
     * Updates an existing Raca model.
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
     * Deletes an existing Raca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->ativo = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Raca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Raca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Raca::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLista_options() {
        $post = Yii::$app->request->post();
        $id = $post['depdrop_parents'];
        $count = Raca::find()->where(['ativo' => '1', 'especie' => $id])->count();
        $lst = Raca::find()->where(['ativo' => '1', 'especie' => $id])->all();

        $htmlResp = array();

        if ($count > 0) {
            foreach ($lst as $value) {
                $htmlResp[] = ['id' => $value->id, 'name' => $value->raca];
            }
        }
        echo Json::encode(['output' => $htmlResp, 'selected' => '']);
        return;
    }

}
