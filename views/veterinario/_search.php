<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VeterinarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="veterinario-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-8">
        <?= $form->field($model, 'nome') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'crmv') ?>
    </div>
    <div class="form-group col-md-12 text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
