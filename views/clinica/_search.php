<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinica-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-3">
        <?= $form->field($model, 'cnpj') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'nome') ?>
    </div>
    <div class="col-md-5">
        <?= $form->field($model, 'razaoSocial') ?>
    </div>
    <div class="form-group col-md-12 text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
