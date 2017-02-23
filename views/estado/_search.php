<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-2">
        <?= $form->field($model, 'sgEstado') ?>
    </div>
    <div class="col-md-7">
        <?= $form->field($model, 'nmEstado') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'prioridade')->dropDownList(['' => 'todos', '1' => 'prioritário', '0' => 'não prioritário']) ?>
    </div>
    <div class="form-group col-md-12 text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
