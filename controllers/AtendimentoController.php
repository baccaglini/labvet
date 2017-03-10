<?php

namespace app\controllers;

use app\models\Atendimento;
use app\models\AtendimentoSearch;
use app\models\Clinica;
use app\models\ExameAmostra;
use app\models\ProprietarioAnimal;
use app\models\Veterinario;
use mPDF;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use app\models\AtendimentoExame;

/**
 * AtendimentoController implements the CRUD actions for Atendimento model.
 */
class AtendimentoController extends Controller {

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
     * Lists all Atendimento models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AtendimentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atendimento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Atendimento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Atendimento();
        $modelsAtendimentoExame = [new AtendimentoExame()];
        $msg = '';

        $post = Yii::$app->request->post();
        if ($post) {

            $transacao = Yii::$app->db->beginTransaction();

            try {
                $model->load($post);

                $model->usuario = Yii::$app->user->getId();

                $model->cadastro = date('Y-m-d H:i:s');

                if ($model->clinica === '') {
                    $model->clinica = NULL;
                }

                $model->ativo = 1;

                if (!$model->save()) {
                    throw new Exception('Erro ao cadastrar atendimento.');
                }

                if (isset($post['arrExame'])) {
                    foreach ($post['arrExame'] as $key => $value) {
                        $modelAtendimentoExame = new AtendimentoExame();
                        $modelAtendimentoExame->atendimento = $model->id;
                        $modelAtendimentoExame->exame = $value;
                        $modelAtendimentoExame->amostra = $post['arrAmostra'][$key];
                        $modelAtendimentoExame->coleta = $post['arrColeta'][$key];
                        $modelAtendimentoExame->valor = $post['arrValor'][$key];
                        $modelAtendimentoExame->liberacao = null;
                        $modelAtendimentoExame->obs = $post['arrObj'][$key];
                        $modelAtendimentoExame->usuario = Yii::$app->user->getId();
                        $modelAtendimentoExame->cadastro = date('Y-m-d H:i:s');
                        $modelAtendimentoExame->ativo = 1;
                        if (!($modelAtendimentoExame->save())) {
                            throw new Exception('Erro ao cadastrar lista de exames.');
                        }
                    }
                }

                $transacao->commit();

                return $this->redirect(['index']);
            } catch (Exception $exc) {
                /** DEU ALGUM ERRO DE EXECUÇÃO */
                /** OBTEM O TEXTO DO ERRO E PASSA PRA _form */
                $msg = $exc->getMessage();
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelsAtendimentoExame' => $modelsAtendimentoExame,
                    'msg' => $msg,
        ]);
    }

    /**
     * Updates an existing Atendimento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelsAtendimentoExame = [new AtendimentoExame()];
        /** busca os exames do atendimento */
        $query = new Query;
        $query->select([
                    'atendimento_exame.atendimento',
                    'atendimento_exame.coleta',
                    'atendimento_exame.valor',
                    'atendimento_exame.liberacao',
                    'atendimento_exame.obs',
                    'exame_amostra.exame as idExame',
                    'exame_amostra.amostra as idAmostra',
                    'exame.exame',
                    'amostra.amostra'
                ])
                ->from('atendimento_exame')
                ->innerJoin('exame_amostra', 'exame_amostra.exame = atendimento_exame.exame and exame_amostra.amostra = atendimento_exame.amostra')
                ->innerJoin('exame', 'exame.id = exame_amostra.exame')
                ->innerJoin('amostra', 'amostra.id = exame_amostra.amostra')
                ->where(['atendimento_exame.atendimento' => $id])
                ->orderBy('exame.exame');
        $command = $query->createCommand();
        $modelsAtendimentoExame = $command->queryAll();

        /** VERIFICA QUAIS EXAMES ESTÃO NO BD */
        $arrExamesBd = array();
        foreach ($modelsAtendimentoExame as $value) {
            $arrExamesBd[] = $value['idExame'];
        }

        /*         * ******************************** */
        $msg = '';

        $post = Yii::$app->request->post();
        if ($post) {

            $transacao = Yii::$app->db->beginTransaction();

            try {
                $model->load($post);

                $model->usuario = Yii::$app->user->getId();

                //$model->cadastro = date('Y-m-d H:i:s');

                if ($model->clinica === '') {
                    $model->clinica = NULL;
                }

                $model->ativo = 1;

                if (!$model->save()) {
                    throw new Exception('Erro ao cadastrar atendimento.');
                }

                if (isset($post['arrExame'])) {
                    foreach ($post['arrExame'] as $key => $value) {
                        $modelAtendimentoExame = new AtendimentoExame();

                        if (!in_array($value, $arrExamesBd)) {
                            /* NÃO ESTA NO BANCO, OU SEJA, É EXAME NOVO */
                            $modelAtendimentoExame->atendimento = $model->id;
                            $modelAtendimentoExame->exame = $value;
                        } else {
                            /* JÁ ESTA CADASTRADO NO BANCO, OU SEJA, É ATUALIZAÇÃO */
                            $modelAtendimentoExame = AtendimentoExame::findOne(['atendimento' => $model->id, 'exame' => $value]);
                        }

                        $modelAtendimentoExame->amostra = $post['arrAmostra'][$key];
                        $modelAtendimentoExame->coleta = $post['arrColeta'][$key];
                        $modelAtendimentoExame->valor = $post['arrValor'][$key];

                        if ($post['arrLiberacao'][$key] === '') {
                            $dateLiberacao = null;
                        } else {
                            $arrDataAux = explode("/", $post['arrLiberacao'][$key]);
                            $dateLiberacao = $arrDataAux[2] . '-' . $arrDataAux[1] . '-' . $arrDataAux[0];
                        }

                        $modelAtendimentoExame->liberacao = $dateLiberacao;
                        $modelAtendimentoExame->obs = $post['arrObj'][$key];
                        $modelAtendimentoExame->usuario = Yii::$app->user->getId();
                        $modelAtendimentoExame->cadastro = date('Y-m-d H:i:s');
                        $modelAtendimentoExame->ativo = 1;

                        if (!in_array($value, $arrExamesBd)) {
                            /* NÃO ESTA NO BANCO, OU SEJA, É EXAME NOVO */
                            if (!($modelAtendimentoExame->save())) {
                                throw new Exception('*Erro ao cadastrar lista de exames. ' . $value);
                            }
                        } else {
                            /* JÁ ESTA CADASTRADO NO BANCO, OU SEJA, É ATUALIZAÇÃO */
                            if (!($modelAtendimentoExame->update())) {
                                throw new Exception('Erro ao atualzar lista de exames.');
                            }
                        }

                        unset($modelAtendimentoExame);
                    }
                }

                $transacao->commit();

                return $this->redirect(['index']);
            } catch (Exception $exc) {
                /** DEU ALGUM ERRO DE EXECUÇÃO */
                /** OBTEM O TEXTO DO ERRO E PASSA PRA _form */
                $msg = $exc->getMessage();
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'modelsAtendimentoExame' => $modelsAtendimentoExame,
                    'msg' => $msg,
        ]);

        /*         * ************************************ */
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            var_dump(Yii::$app->request->post());
//            exit();
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                        'model' => $model,
//                        'modelsAtendimentoExame' => $modelsAtendimentoExame,
//                        'msg' => $msg,
//            ]);
//        }
    }

    /**
     * Deletes an existing Atendimento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Atendimento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Atendimento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Atendimento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
