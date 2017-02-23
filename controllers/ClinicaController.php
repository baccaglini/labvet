<?php

namespace app\controllers;

use app\base\Model;
use app\models\Clinica;
use app\models\ClinicaEmail;
use app\models\ClinicaEndereco;
use app\models\ClinicaFone;
use app\models\ClinicaSearch;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ClinicaController implements the CRUD actions for Clinica model.
 */
class ClinicaController extends Controller {

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
     * Lists all Clinica models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ClinicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clinica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clinica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Clinica();
        $modelEndereco = new ClinicaEndereco();
        $modelsEmail = [new ClinicaEmail()];
        $modelsFone = [new ClinicaFone()];

        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            /** FORMULÁRIO FOI SUBMETIDO */
            $transacao = Yii::$app->db->beginTransaction();
            try {
                /** SALVA OS DADOS DE PROPRIETÁRIO */
                $model->load($post);
                $model->ativo = 1;
                $model->cadastro = date('Y-m-d H:i:s');
                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados de Clínica.');
                }

                /** SALVA OS DADOS DE ENDEREÇO */
                $modelEndereco->load($post);
                $modelEndereco->clinica = $model->id;
                $modelEndereco->ativo = 1;
                $modelEndereco->sequencia = 1;
                $modelEndereco->principal = 0;
                if (!$modelEndereco->save()) {
                    throw new Exception('Erro ao salvar dados de Endereço.');
                }

                /** SALVA OS DADOS DE EMAIL */
                $modelsEmail = Model::createMultiple(ClinicaEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->clinica = $model->id;
                        $modelEmail->sequencia = $aux;
                        $modelEmail->ativo = 1;
                        $aux++;
                        if (!($modelEmail->save())) {
                            throw new Exception('Erro ao cadastrar E-mail.');
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }

                /** SALVA OS DADOS DE FONE */
                $modelsFone = Model::createMultiple(ClinicaFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->clinica = $model->id;
                        $modelFone->sequencia = $aux;
                        $modelFone->ativo = 1;
                        $modelFone->principal = 0;
                        $aux++;
                        if (!($modelFone->save())) {
                            throw new Exception('Erro ao cadastrar E-mail.');
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }

                $transacao->commit();
                return $this->redirect(['index']);
            } catch (Exception $exc) {
                /** DEU ALGUM ERRO DE EXECUÇÃO */
                $transacao->rollBack();
                /** OBTEM O TEXTO DO ERRO E PASSA PRA _form */
                $msg = $exc->getMessage();
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelEndereco' => $modelEndereco,
                    'modelsEmail' => $modelsEmail,
                    'modelsFone' => $modelsFone,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Clinica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelEndereco = ClinicaEndereco::findOne(['clinica' => $id]);
        $modelsEmail = ClinicaEmail::findAll(['clinica' => $id, 'ativo' => 1]);
        $modelsFone = ClinicaFone::findAll(['clinica' => $id, 'ativo' => 1]);
        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            /** DADOS FORAM ENVIADOS VIA FORMULÁRIO */
            $transacao = Yii::$app->db->beginTransaction();
            try {
                /** SALVA OS DADOS DE PROPRIETÁRIO */
                $model->load($post);
                $model->ativo = 1;
                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados de Veterinário.');
                }

                /** SALVA OS DADOS DE ENDEREÇO */
                $modelEndereco->load($post);
                if (!$modelEndereco->save()) {
                    throw new Exception('Erro ao salvar dados de Endereço.');
                }

                /** SALVA OS DADOS DE EMAIL */
                ClinicaEmail::deleteAll(['clinica' => $id]);
                $modelsEmail = Model::createMultiple(ClinicaEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->clinica = $model->id;
                        $modelEmail->sequencia = $aux;
                        $modelEmail->ativo = 1;
                        $aux++;
                        if (!($modelEmail->save())) {
                            throw new Exception('Erro ao cadastrar E-mail.');
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }

                /** SALVA OS DADOS DE FONE */
                ClinicaFone::deleteAll(['clinica' => $id]);
                $modelsFone = Model::createMultiple(ClinicaFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->clinica = $model->id;
                        $modelFone->sequencia = $aux;
                        $modelFone->ativo = 1;
                        $modelFone->principal = 0;
                        $aux++;
                        if (!($modelFone->save())) {
                            throw new Exception('Erro ao cadastrar E-mail.');
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }
                
                $transacao->commit();
                return $this->redirect(['index']);
            } catch (Exception $exc) {
                /** DEU ALGUM ERRO DE EXECUÇÃO */
                $transacao->rollBack();
                /** OBTEM O TEXTO DO ERRO E PASSA PRA _form */
                $msg = $exc->getMessage();
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'modelEndereco' => $modelEndereco,
                    'modelsEmail' => $modelsEmail,
                    'modelsFone' => $modelsFone,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing Clinica model.
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
     * Finds the Clinica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clinica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Clinica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLista_options() {
        $post = Yii::$app->request->post();
        $id = $post['depdrop_parents'];
        $count = Clinica::find()
                ->innerJoin('veterinario_clinica', 'veterinario_clinica.clinica = clinica.id')
                ->where(['veterinario_clinica.veterinario' => $id])
                ->count();

        $lst = Clinica::find()
                ->innerJoin('veterinario_clinica', 'veterinario_clinica.clinica = clinica.id')
                ->where(['veterinario_clinica.veterinario' => $id])
                ->orderBy('clinica.nome')
                ->all();

        $htmlResp = array();

        if ($count > 0) {
            foreach ($lst as $valor) {
                $htmlResp[] = ['id' => $valor->id, 'name' => $valor->nome];
            }
        }
        echo Json::encode(['output' => $htmlResp, 'selected' => '']);
        return;
    }

}
