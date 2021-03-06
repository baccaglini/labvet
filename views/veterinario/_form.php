<?php

use app\models\Cidade;
use app\models\Clinica;
use app\models\Estado;
use app\models\Veterinario;
use app\models\VeterinarioClinica;
use app\models\VeterinarioEmail;
use app\models\VeterinarioEndereco;
use app\models\VeterinarioFone;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model Veterinario */
/* @var $modelEndereco VeterinarioEndereco */
/* @var $modelsEmail VeterinarioEmail */
/* @var $modelsFone VeterinarioFone */
/* @var $form ActiveForm */


$dataCidade = array();
$modelVeterinarioClinica = new VeterinarioClinica();

if (!$model->isNewRecord) {
    $arrAux = array();
    foreach ($modelsClinica as $modelClinica) {
        if ($modelClinica->ativo) {
            $arrAux[] = $modelClinica->clinica;
        }
    }

    $modelVeterinarioClinica->clinica = $arrAux;

    $dataCidade = ArrayHelper::map(Cidade::find()->where(['idEstado' => $modelEndereco->uf])->orderBy('prioridade desc, nmCidades')->all(), 'id', 'nmCidades');
}
?>

<div class="veterinario-form">

    <?php $form = ActiveForm::begin(['id' => 'form_veterinario']); ?>

    <?php if ($msg != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <strong>Erro!</strong><?= $msg; ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Veterinário</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'crmv')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Endereço</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <?=
                    $form->field($modelEndereco, 'cep')->widget(MaskedInput::className(), [
                        'mask' => '99.999-999',
                    ])
                    ?>
                </div>
                <div class="col-md-2">
                    <?=
                    $form->field($modelEndereco, 'uf')->dropDownList(ArrayHelper::map(Estado::find()->orderBy('prioridade desc, sgEstado')->all(), 'id', 'sgEstado'), [
                        'prompt' => '-- selecione o estado',
                    ]);
                    ?>
                </div>
                <div class="col-md-8">
                    <?=
                    $form->field($modelEndereco, 'cidade')->widget(DepDrop::classname(), [
                        'data' => $dataCidade,
                        'pluginOptions' => [
                            'depends' => ['veterinarioendereco-uf'],
                            'placeholder' => '-- selecione a cidade',
                            'url' => Url::to(['/cidade/lista_options'])
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($modelEndereco, 'logradouro')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($modelEndereco, 'numero')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelEndereco, 'bairro')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsEmail[0],
        'formId' => 'form_veterinario',
        'formFields' => [
            'sequencia',
            'email',
        ],
    ]);
    ?>

    <div class="container-items">  
        <?php foreach ($modelsEmail as $i => $modelEmail): ?>
            <div class="item panel panel-primary">  
                <div class="panel-heading">
                    <h3 class="panel-title pull-left ">E-mail</h3>
                    <div class="pull-right">
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$model->isNewRecord) {
                        echo Html::activeHiddenInput($modelEmail, "[{$i}]sequencia");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($modelEmail, "[{$i}]principal")->dropDownList(['0' => 'não principal', '1' => 'principal']) ?>
                        </div>
                        <div class="col-sm-10">
                            <?= $form->field($modelEmail, "[{$i}]email")->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> incluir mais email</button>
        </div>
    </div>
    <hr />
    <?php DynamicFormWidget::end(); ?>

    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-fones', // required: css class selector
        'widgetItem' => '.fone', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-fone', // css class
        'deleteButton' => '.remove-fone', // css class
        'model' => $modelsFone[0],
        'formId' => 'form_veterinario',
        'formFields' => [
            'sequencia',
            'email',
        ],
    ]);
    ?>

    <div class="container-fones">  
        <?php foreach ($modelsFone as $i => $modelFone): ?>
            <div class="fone panel panel-primary">  
                <div class="panel-heading">
                    <h3 class="panel-title pull-left ">Fone</h3>
                    <div class="pull-right">
                        <button type="button" class="remove-fone btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$model->isNewRecord) {
                        echo Html::activeHiddenInput($modelFone, "[{$i}]sequencia");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($modelFone, "[{$i}]fone")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-8">
                            <?= $form->field($modelFone, "[{$i}]obs")->textarea(['rows' => 1]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="add-fone btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> incluir mais fone</button>
        </div>
    </div>
    <hr />
    <?php DynamicFormWidget::end(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Clinica(s)</h3>
        </div>
        <div class="panel-body">
            <?=
            $form->field($modelVeterinarioClinica, 'clinica')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Clinica::find()->all(), 'id', 'nome'),
                'language' => 'pt-BR',
                'options' => ['placeholder' => 'Selecione a(s) clinica(s)...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                ]
            ])->label('');
            ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
