<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEmail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinica-email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clinica')->textInput() ?>

    <?= $form->field($model, 'sequencia')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
