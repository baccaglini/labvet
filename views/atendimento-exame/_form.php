<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoExame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atendimento-exame-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'atendimento')->textInput() ?>

    <?= $form->field($model, 'exame')->textInput() ?>

    <?= $form->field($model, 'amostra')->textInput() ?>

    <?= $form->field($model, 'coleta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'liberacao')->textInput() ?>

    <?= $form->field($model, 'obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario')->textInput() ?>

    <?= $form->field($model, 'cadastro')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
