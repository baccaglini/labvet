<?php

namespace app\controllers;

use app\models\Exame;
use app\models\ExameAmostra;
use app\models\ExameSearch;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ExameController implements the CRUD actions for Exame model.
 */
class ExameController extends Controller {

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
     * Lists all Exame models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ExameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exame model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Exame model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Exame();
        $modelsExameAmostra = [new ExameAmostra()];
        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            $transacao = Yii::$app->db->beginTransaction();
            /** SALVA EXAME */
            $model->load($post);
            try {
                $model->ativo = 1;
                if (!$model->save()) {
                    /** ERRO AO SALVAR EXAME */
                    throw new Exception('Erro ao salvar dados de Proprietário.');
                }

                /** SALVA RELACIONAMENTO COM AMOSTRA */
                /** SALVA OS DADOS EXAME x AMOSTRA */
                $postAmostra = $post['ExameAmostra'];
                /** SÓ VAI RELACIONAR COM AMOSTRA SE TIVER ALGUM VALOR VÁLIDO */
                if (count($postAmostra['amostra']) > 1 || (count($postAmostra['amostra']) == 1 && $postAmostra['amostra'] != '')) {
                    foreach ($postAmostra['amostra'] as $value) {
                        $auxModelExameAmostra = new ExameAmostra();
                        $auxModelExameAmostra->exame = $model->id;
                        $auxModelExameAmostra->amostra = $value;
                        $auxModelExameAmostra->ativo = 1;
                        if (!$auxModelExameAmostra->save()) {
                            throw new Exception('Erro ao relacionar com amostra.');
                        }
                        unset($auxModelExameAmostra);
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
                    'modelsExameAmostra' => $modelsExameAmostra,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Exame model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelsExameAmostra = ExameAmostra::findAll(['exame' => $id]);
        $msg = '';

        $post = Yii::$app->request->post();

        if ($post) {
            $transacao = Yii::$app->db->beginTransaction();
            /** SALVA EXAME */
            $model->load($post);
            try {
                if (!$model->save()) {
                    /** ERRO AO SALVAR EXAME */
                    throw new Exception('Erro ao salvar dados de Proprietário.');
                }


                /** TRATA OS DADOS DE VETERINARIO x CLINICA */
                $postAmostra = $post['ExameAmostra'];
                /** VERIFICA QUAIS CLINICAS ESTÃO NA LISTA DO POST */
                if (count($postAmostra['amostra']) > 1 || (count($postAmostra['amostra']) == 1 && $postAmostra['amostra'] != '')) {
                    foreach ($postAmostra['amostra'] as $value) {
                        $arrAmostraPost[] = $value;
                    }
                } else {
                    /** NÃO TEM NENHUMA CLINICA */
                    $arrAmostraPost = array();
                }

                /** VERIFICA QUAIS CLINICAS ESTÃO NO BD */
                $arrAmostraBd = array();
                foreach ($modelsExameAmostra as $value) {
                    $arrAmostraBd[] = $value->amostra;
                }
                
                /** INATIVA AS CLINICAS QUE ESTÃO EM BD MAS NÃO ESTÃO NO POST */
                foreach ($arrAmostraBd as $valueBd) {
                    $auxExameAmostra = new ExameAmostra();
                    if (!in_array($valueBd, $arrAmostraPost)) {
                        $auxExameAmostra = ExameAmostra::findOne(['exame' => $id, 'amostra' => $valueBd]);
                        $auxExameAmostra->ativo = 0;                        
                        if (!$auxExameAmostra->save()) {
                            throw new Exception('01 - Erro ao relacionar com amostra.');
                        }
                    }
                    unset($auxExameAmostra);
                }

                /** INSERE AS CLINICAS QUE ESTÃO EM POST MAS NÃO ESTÃO NO BD */
                foreach ($arrAmostraPost as $valuePost) {
                    $auxExameAmostra = new ExameAmostra();
                    if (!in_array($valuePost, $arrAmostraBd)) {
                        $auxExameAmostra->amostra = $valuePost;
                        $auxExameAmostra->exame = $id;
                        $auxExameAmostra->ativo = 1;
                        if (!$auxExameAmostra->save()) {
                            throw new Exception('02 - Erro ao relacionar com amostra.');
                        }
                    } else {
                        /** CASO ESTEJA EM BD E EM POST VERIFICA SE ESTA INATIVO EM BD E REATIVA  */
                        $auxExameAmostra = $auxExameAmostra->findOne(['amostra' => $valuePost, 'exame' => $id]);
                        if ($auxExameAmostra->ativo === 0) {
                            $auxExameAmostra->ativo = 1;
                            if (!$auxExameAmostra->save()) {
                                throw new Exception('03 - Erro ao relacionar com amostra.');
                            }
                        }
                    }
                    unset($auxExameAmostra);
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
                    'modelsExameAmostra' => $modelsExameAmostra,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing Exame model.
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

    public function actionDados_exame() {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = $this->findModel($id);

        $resp['valor'] = $model->valor;
        echo (json_encode($resp, JSON_PRETTY_PRINT));
        return;
    }

    /**
     * Finds the Exame model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Exame::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
