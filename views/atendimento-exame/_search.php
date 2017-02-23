<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoExameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atendimento-exame-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'atendimento') ?>

    <?= $form->field($model, 'exame') ?>

    <?= $form->field($model, 'amostra') ?>

    <?= $form->field($model, 'coleta') ?>

    <?= $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'liberacao') ?>

    <?php // echo $form->field($model, 'obs') ?>

    <?php // echo $form->field($model, 'usuario') ?>

    <?php // echo $form->field($model, 'cadastro') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
