<?php

use app\models\Especie;
use app\models\Proprietario;
use app\models\ProprietarioAnimal;
use app\models\Raca;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ProprietarioAnimal */
/* @var $form ActiveForm */
$modelEspecie = new Especie();
$lstRaca = array();
if (!$model->isNewRecord) {
    $modelRaca = Raca::findOne(['id' => $model->raca]);
    $modelEspecie = Especie::findOne(['id' => $modelRaca->especie]);    
    $lstRaca = ArrayHelper::map(Raca::findAll(['especie' => $modelRaca->especie]), 'id', 'raca');;
}
?>

<div class="proprietario-animal-form">

    <?php if ($msg != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <strong>Erro!</strong><?= $msg; ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'proprietario')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Proprietario::find()->where(['ativo' => 1])->all(), 'id', 'nome', 'cpf'),
        'language' => 'pt-BR',
        'options' => ['placeholder' => 'Select o proprietário ...'],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'animal')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group field-feriado-data required col-sm-4">
            <label class="control-label" for="feriado-data">Data</label>
            <?=
            DatePicker::widget([
                'model' => $model,
                'attribute' => 'nascimento',
                'language' => 'pt-BR',
            ]);
            ?>
            <div class="help-block"></div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <?=
            $form->field($modelEspecie, 'id')->dropDownList(ArrayHelper::map(Especie::find()->orderBy('especie')->all(), 'id', 'especie'), [
                'prompt' => '-- selecione a especie',
            ])->label('Especie');
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'raca')->widget(DepDrop::classname(), [
                'data' => $lstRaca,
                'pluginOptions' => [
                    'depends' => ['especie-id'],
                    'placeholder' => '-- selecione a raça',
                    'url' => Url::to(['/raca/lista_options'])
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'sexo')->dropDownList(['' => 'Selecione o sexo', 'M' => 'macho', 'F' => 'femea', 'ND' => 'não identificado']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'cor')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'obs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
