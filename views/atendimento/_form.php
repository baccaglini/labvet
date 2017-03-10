<?php

use app\models\Atendimento;
use app\models\Clinica;
use app\models\Exame;
use app\models\ExameAmostra;
use app\models\Proprietario;
use app\models\ProprietarioAnimal;
use app\models\Veterinario;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this View */
/* @var $model Atendimento */

/* @var $form ActiveForm */

$dataAnimal = array();
$dataClinica = array();
$dataAmostra = array();

$arrExamesCadastrados = Array();
$arrExamesCadastrados[] = 0;

if (!$model->isNewRecord) {
    $dataAnimal = ArrayHelper::map(ProprietarioAnimal::find()
                            ->where(['proprietario' => $model->proprietario])
                            ->orderBy('animal')
                            ->all(), 'sequencia', 'animal', 'raca0.especie0.especie');

    $dataClinica = ArrayHelper::map(Clinica::find()
                            ->innerJoin('veterinario_clinica', 'veterinario_clinica.clinica = clinica.id')
                            ->where(['veterinario_clinica.veterinario' => $model->veterinario])
                            ->orderBy('clinica.nome')
                            ->all(), 'id', 'nome');

    if (count($modelsAtendimentoExame) > 0) {
        foreach ($modelsAtendimentoExame as $key => $value) {
            $arrExamesCadastrados[] = $value['idExame'];
        }
    }
}

$modelsExameAmostra = [new ExameAmostra()];

$modelAtendimentoExame = new app\models\AtendimentoExame();
?>

<div class="atendimento-form">

    <?php if ($msg != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <strong>Erro!</strong><?= $msg; ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['id' => 'form_atendimento']); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Animal</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'proprietario')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Proprietario::find()->all(), 'id', 'nome', 'cpf'),
                        'language' => 'pt-BR',
                        'options' => ['placeholder' => 'Select o proprietário ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'id' => 'atendimento-proprietario'
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'sequencia')->widget(DepDrop::classname(), [
                        'data' => $dataAnimal,
                        'pluginOptions' => [
                            'depends' => ['atendimento-proprietario'],
                            'placeholder' => '-- selecione o animal',
                            'url' => Url::to(['/proprietario-animal/lista_options'])
                        ]
                    ])->label('Animal');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Veterinario</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'veterinario')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Veterinario::find()->all(), 'id', 'nome', 'crmv'),
                        'language' => 'pt-BR',
                        'options' => ['placeholder' => 'Select o veter ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'id' => 'atendimento-veterinario',
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'clinica')->widget(DepDrop::classname(), [
                        'data' => $dataClinica,
                        'pluginOptions' => [
                            'depends' => ['atendimento-veterinario'],
                            'placeholder' => '-- selecione a clinica',
                            'url' => Url::to(['/clinica/lista_options'])
                        ]
                    ])->label('Clinica');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- lista de exames -->
    <div class="item panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Exame</h3>
            <div class="pull-right">
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?=
                    $form->field($modelAtendimentoExame, "exame")->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Exame::find()->where(['not in', 'id', $arrExamesCadastrados])->all(), 'id', 'exame'),
                        'language' => 'pt-BR',
                        'options' => ['placeholder' => 'Select o exame ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'id' => 'atendimentoexame-exame',
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?=
                    $form->field($modelAtendimentoExame, "amostra")->widget(DepDrop::classname(), [
                        'data' => $dataAmostra,
                        'pluginOptions' => [
                            'depends' => ['atendimentoexame-exame'],
                            'placeholder' => '-- selecione a amostra',
                            'url' => Url::to(['/amostra/lista_options'])
                        ]
                    ])->label('Amostra');
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelAtendimentoExame, "coleta")->dropDownList(['' => 'Defina a Coleta', 'AC' => 'Amostra Coletada', 'AR' => 'Amostra Recebida']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($modelAtendimentoExame, "valor")->textInput() ?>
                </div>
                <div class="form-group field-feriado-data required col-sm-3">
                    <?php if (!$model->isNewRecord): ?>
                        <label class="control-label" for="feriado-data">Liberação</label>
                        <?php
                        echo
                        DatePicker::widget([
                            'model' => $modelAtendimentoExame,
                            'attribute' => 'liberacao',
                            'language' => 'pt-BR',
                                //'dateFormat' => 'yyyy-MM-dd',
                        ]);
                        ?>
                        <div class="help-block"></div>
                    <?php else: ?>
                        <?= $form->field($modelAtendimentoExame, "liberacao")->hiddenInput(); ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($modelAtendimentoExame, "obs")->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-items">  
        <div class="item panel panel-primary">  
            <div class="panel-heading">
                <h3 class="panel-title pull-left ">Exames</h3>
                <div class="pull-right">
                    <button name="btnAddExameAtendimento" id="btnAddExameAtendimento" type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table" id="tblListaExames" >
                    <thead>
                        <tr>
                            <th>Exame</th>
                            <th>Amostra</th>
                            <th>Coleta</th>
                            <th>Valor</th>
                            <th>Liberação</th>
                            <th>Obs.</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$model->isNewRecord): ?>
                            <?php if (count($modelsAtendimentoExame) > 0): ?>
                                <?php foreach ($modelsAtendimentoExame as $key => $value): ?>
                                    <tr>
                                        <td><?= $value['exame']; ?><input type="hidden" name="arrExame[]" value="<?= $value['idExame']; ?>" /></td>
                                        <td><?= $value['amostra']; ?><input type="hidden" name="arrAmostra[]" value="<?= $value['idAmostra']; ?>" /></td>
                                        <td><?= $value['coleta']; ?><input type="hidden" name="arrColeta[]" value="<?= $value['coleta']; ?>" /></td>
                                        <td><?= $value['valor']; ?><input type="hidden" name="arrValor[]" value="<?= $value['valor']; ?>" /></td>

                                        <td>
                                            <?php
                                            echo DatePicker::widget([
                                                'name' => 'arrLiberacao[]',
                                                'value' => (is_null($value['liberacao'])) ? '' : Yii::$app->formatter->asDate($value['liberacao'], 'php:d/m/Y'),
                                                'language' => 'pt-BR',
                                                    //'dateFormat' => 'dd/MM/yyyy',
                                            ]);
                                            ?>
                                        </td>

                                        <td><?= $value['obs']; ?><input type="hidden" name="arrObj[]" value="<?= $value['obs']; ?>" /></td>
                                        <td>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12 form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
