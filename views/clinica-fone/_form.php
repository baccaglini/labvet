<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaFone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinica-fone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clinica')->textInput() ?>

    <?= $form->field($model, 'sequencia')->textInput() ?>

    <?= $form->field($model, 'principal')->textInput() ?>

    <?= $form->field($model, 'fone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
