<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEndereco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinica-endereco-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clinica')->textInput() ?>

    <?= $form->field($model, 'sequencia')->textInput() ?>

    <?= $form->field($model, 'principal')->textInput() ?>

    <?= $form->field($model, 'cep')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade')->textInput() ?>

    <?= $form->field($model, 'uf')->textInput() ?>

    <?= $form->field($model, 'logradouro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
