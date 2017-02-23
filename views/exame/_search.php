<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exame-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-6">
        <?= $form->field($model, 'exame') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'valor') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'prazo') ?>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
