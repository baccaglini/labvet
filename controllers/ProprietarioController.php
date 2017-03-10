<?php

namespace app\controllers;

use app\base\Model;
use app\models\Proprietario;
use app\models\ProprietarioAnimal;
use app\models\ProprietarioEmail;
use app\models\ProprietarioEndereco;
use app\models\ProprietarioFone;
use app\models\ProprietarioSearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProprietarioController implements the CRUD actions for Proprietario model.
 */
class ProprietarioController extends Controller {

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
     * Lists all Proprietario models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProprietarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proprietario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Proprietario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Proprietario();
        $modelEndereco = new ProprietarioEndereco();
        $modelsEmail = [new ProprietarioEmail()];
        $modelsFone = [new ProprietarioFone()];
        $modelsAnimal = [new ProprietarioAnimal()];

        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            /** FORMULÁRIO FOI SUBMETIDO */
            $transacao = Yii::$app->db->beginTransaction();
            try {
                /** SALVA OS DADOS DE PROPRIETÁRIO */
                $model->load($post);
                $model->ativo = 1;

                $model->cpf = preg_replace('/[^0-9]/', '', $model->cpf);

                if ($model->cpf === '') {
                    $model->cpf = null;
                }

                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados de Proprietário.');
                }

                /** SALVA OS DADOS DE ENDEREÇO */
                $modelEndereco->load($post);
                if ($modelEndereco->uf !== '') {
                    /* ...SE TIVER VALOR PRA SALVAR */
                    $modelEndereco->proprietario = $model->id;
                    $modelEndereco->ativo = 1;
                    if (!$modelEndereco->save()) {
                        throw new Exception('Erro ao salvar dados de Proprietário.');
                    }
                }

                /** SALVA OS DADOS DE EMAIL */
                $modelsEmail = Model::createMultiple(ProprietarioEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->proprietario = $model->id;
                        $modelEmail->sequencia = $aux;
                        $modelEmail->ativo = 1;

                        if ($modelEmail->email !== '') {
                            $aux++;
                            if (!($modelEmail->save())) {
                                throw new Exception('Erro ao cadastrar E-mail.');
                            }
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }

                /** SALVA OS DADOS DE FONE */
                $modelsFone = Model::createMultiple(ProprietarioFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->proprietario = $model->id;
                        $modelFone->sequencia = $aux;
                        $modelFone->ativo = 1;
                        if ($modelFone->fone !== '') {
                            $aux++;
                            if (!($modelFone->save())) {
                                throw new Exception('Erro ao cadastrar E-mail.');
                            }
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
                    'modelsAnimal' => $modelsAnimal,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Proprietario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelEndereco = ProprietarioEndereco::findOne(['proprietario' => $id]);
        $modelsEmail = ProprietarioEmail::findAll(['proprietario' => $id, 'ativo' => 1]);
        $modelsFone = ProprietarioFone::findAll(['proprietario' => $id, 'ativo' => 1]);
        $modelsAnimal = ProprietarioAnimal::findAll(['proprietario' => $id, 'ativo' => 1]);
        $msg = '';

        if (count($modelsEmail) == 0) {
            $modelsEmail = [new ProprietarioEmail()];
        }

        if (count($modelsFone) == 0) {
            $modelsFone = [new ProprietarioFone()];
        }

        $post = Yii::$app->request->post();

        if ($post) {
            /** DADOS FORAM ENVIADOS VIA FORMULÁRIO */
            $transacao = Yii::$app->db->beginTransaction();
            try {
                /** SALVA OS DADOS DE PROPRIETÁRIO */
                $model->load($post);
                $model->ativo = 1;

                $model->cpf = preg_replace('/[^0-9]/', '', $model->cpf);

                if ($model->cpf === '') {
                    $model->cpf = null;
                }

                if (!$model->save()) {
                    throw new Exception('Erro ao salvar dados de Veterinário.');
                }

                /** SALVA OS DADOS DE ENDEREÇO */
                $modelEndereco->load($post);
                if ($modelEndereco->uf !== '') {
                    if (!$modelEndereco->save()) {
                        throw new Exception('Erro ao salvar dados de Endereço.');
                    }
                }

                /** SALVA OS DADOS DE EMAIL */
                ProprietarioEmail::deleteAll(['proprietario' => $id]);
                $modelsEmail = Model::createMultiple(ProprietarioEmail::classname());
                if (Model::loadMultiple($modelsEmail, $post)) {
                    $aux = 1;
                    foreach ($modelsEmail as $modelEmail) {
                        $modelEmail->proprietario = $model->id;
                        $modelEmail->sequencia = $aux;
                        $modelEmail->ativo = 1;

                        if ($modelEmail->email !== '') {
                            $aux++;
                            if (!($modelEmail->save())) {
                                throw new Exception('Erro ao cadastrar E-mail.');
                            }
                        }
                    }
                } else {
                    throw new Exception('Erro ao cadastrar E-mail.');
                }

                /** SALVA OS DADOS DE FONE */
                ProprietarioFone::deleteAll(['proprietario' => $id]);
                $modelsFone = Model::createMultiple(ProprietarioFone::classname());
                if (Model::loadMultiple($modelsFone, $post)) {
                    $aux = 1;
                    foreach ($modelsFone as $modelFone) {
                        $modelFone->proprietario = $model->id;
                        $modelFone->sequencia = $aux;
                        $modelFone->ativo = 1;

                        if ($modelFone->fone !== '') {
                            $aux++;
                            if (!($modelFone->save())) {
                                throw new Exception('Erro ao cadastrar E-mail.');
                            }
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
                    'modelsAnimal' => $modelsAnimal,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing Proprietario model.
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
     * Finds the Proprietario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proprietario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Proprietario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
