<?php

use app\models\Estado;
use app\models\Cidade;
use app\models\Proprietario;
use app\models\ProprietarioEndereco;
use kartik\depdrop\DepDrop;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model Proprietario */
/* @var $modelEndereco ProprietarioEndereco */
/* @var $form ActiveForm */

$dataCidade = array();
if (!$model->isNewRecord) {
    $dataCidade = ArrayHelper::map(Cidade::find()
                            ->where(['idEstado' => $modelEndereco->uf])
                            ->orderBy([
                                'prioridade' => SORT_DESC, 
                                'nmCidades' => SORT_ASC,
                                ])->all(), 'id', 'nmCidades');
}
?>

<div class="proprietario-form">

    <?php $form = ActiveForm::begin(['id' => 'form_proprietario']); ?>

    <?php if ($msg != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <strong>Erro!</strong><?= $msg; ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Proprietário</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'cpf')->widget(MaskedInput::className(), [
                        'mask' => '999.999.999-99',
                    ])
                    ?>
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
                            'depends' => ['proprietarioendereco-uf'],
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
        'formId' => 'form_proprietario',
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
                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
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
        'formId' => 'form_proprietario',
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
                        <button type="button" class="add-fone btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
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
    <?php DynamicFormWidget::end(); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
