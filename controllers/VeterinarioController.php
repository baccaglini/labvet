<?php

namespace app\controllers;

use app\models\Veterinario;
use app\models\VeterinarioClinica;
use app\models\VeterinarioEmail;
use app\models\VeterinarioEndereco;
use app\models\VeterinarioFone;
use app\models\VeterinarioSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\base\Model;
use yii\base\Exception;

/**
 * VeterinarioController implements the CRUD actions for Veterinario model.
 */
class VeterinarioController extends Controller {

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
     * Lists all Veterinario models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VeterinarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Veterinario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Veterinario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Veterinario();
        $modelEndereco = new VeterinarioEndereco();
        $modelsEmail = [new VeterinarioEmail()];
        $modelsFone = [new VeterinarioFone()];
        $modelsClinica = [new VeterinarioClinica()];

        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            /** FORMULÁRIO FOI SUBMETIDO */
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
                $modelEndereco->veterinario = $model->id;
                $modelEndereco->ativo = 1;
                if (!$modelEndereco->save()) {
                    throw new Exception('Erro ao salvar dados de Endereço.');
                }

                /** SALVA OS DADOS DE EMAIL */
                $modelsEmail = Model::createMultiple(VeterinarioEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->veterinario = $model->id;
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
                $modelsFone = Model::createMultiple(VeterinarioFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->veterinario = $model->id;
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

                /** SALVA OS DADOS VETERINARIO x CLINICAS */
                $postClinicas = $post['VeterinarioClinica'];
                /** SÓ VAI RELACIONAR COM CLINICA SE TIVER ALGUM VALOR VÁLIDO */
                if (count($postClinicas['clinica']) > 1 || (count($postClinicas['clinica']) == 1 && $postClinicas['clinica'] != '')) {
                    foreach ($postClinicas['clinica'] as $value) {
                        $auxModelVeterinarioClinica = new VeterinarioClinica();
                        $auxModelVeterinarioClinica->veterinario = $model->id;
                        $auxModelVeterinarioClinica->clinica = $value;
                        $auxModelVeterinarioClinica->ativo = 1;
                        if (!$auxModelVeterinarioClinica->save()) {
                            throw new Exception('Erro ao relacionar com clinica.');
                        }
                        unset($auxModelVeterinarioClinica);
                    }
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
                    'modelsClinica' => $modelsClinica,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Veterinario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelEndereco = VeterinarioEndereco::findOne(['veterinario' => $id]);
        $modelsEmail = VeterinarioEmail::findAll(['veterinario' => $id]);
        $modelsFone = VeterinarioFone::findAll(['veterinario' => $id]);
        $modelsClinica = VeterinarioClinica::findAll(['veterinario' => $id]);
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
                VeterinarioEmail::deleteAll(['veterinario' => $id]);
                $modelsEmail = Model::createMultiple(VeterinarioEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->veterinario = $model->id;
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
                VeterinarioFone::deleteAll(['veterinario' => $id]);
                $modelsFone = Model::createMultiple(VeterinarioFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->veterinario = $model->id;
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

                /** TRATA OS DADOS DE VETERINARIO x CLINICA */
                $postClinicas = $post['VeterinarioClinica'];
                /** VERIFICA QUAIS CLINICAS ESTÃO NA LISTA DO POST */
                if (count($postClinicas['clinica']) > 1 || (count($postClinicas['clinica']) == 1 && $postClinicas['clinica'] != '')) {
                    foreach ($postClinicas['clinica'] as $value) {
                        $arrClinicaPost[] = $value;
                    }
                } else {
                    /** NÃO TEM NENHUMA CLINICA */
                    $arrClinicaPost = array();
                }

                /** VERIFICA QUAIS CLINICAS ESTÃO NO BD */
                $arrClinicaBd = array();
                foreach ($modelsClinica as $value) {
                    $arrClinicaBd[] = $value->clinica;
                }
                
                /** INATIVA AS CLINICAS QUE ESTÃO EM BD MAS NÃO ESTÃO NO POST */
                foreach ($arrClinicaBd as $valueBd) {
                    $auxVeterinarioClinica = new VeterinarioClinica();
                    if (!in_array($valueBd, $arrClinicaPost)) {
                        $auxVeterinarioClinica = $auxVeterinarioClinica->findOne(['clinica' => $valueBd, 'veterinario' => $id]);
                        if ($auxVeterinarioClinica->ativo !== 0) {
                            $auxVeterinarioClinica->ativo = 0;
                            if (!$auxVeterinarioClinica->update()) {
                                throw new Exception('01 - Erro ao relacionar com clinica.');
                            }
                        }
                    }
                    unset($auxVeterinarioClinica);
                }

                /** INSERE AS CLINICAS QUE ESTÃO EM POST MAS NÃO ESTÃO NO BD */
                foreach ($arrClinicaPost as $valuePost) {
                    $auxVeterinarioClinica = new VeterinarioClinica();
                    if (!in_array($valuePost, $arrClinicaBd)) {
                        $auxVeterinarioClinica->clinica = $valuePost;
                        $auxVeterinarioClinica->veterinario = $id;
                        $auxVeterinarioClinica->ativo = 1;
                        if (!$auxVeterinarioClinica->save()) {
                            throw new Exception('02 - Erro ao relacionar com clinica.');
                        }
                    } else {
                        /** CASO ESTEJA EM BD E EM POST VERIFICA SE ESTA INATIVO EM BD E REATIVA  */
                        $auxVeterinarioClinica = $auxVeterinarioClinica->findOne(['clinica' => $valuePost, 'veterinario' => $id]);
                        if ($auxVeterinarioClinica->ativo === 0) {
                            $auxVeterinarioClinica->ativo = 1;
                            if (!$auxVeterinarioClinica->update()) {
                                throw new Exception('03 - Erro ao relacionar com clinica.');
                            }
                        }
                    }
                    unset($auxVeterinarioClinica);
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
                    'modelsClinica' => $modelsClinica,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing Veterinario model.
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
     * Finds the Veterinario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Veterinario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Veterinario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
