<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaFoneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinica-fone-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'clinica') ?>

    <?= $form->field($model, 'sequencia') ?>

    <?= $form->field($model, 'principal') ?>

    <?= $form->field($model, 'fone') ?>

    <?= $form->field($model, 'obs') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
