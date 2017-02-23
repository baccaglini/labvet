<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProprietarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proprietario-search">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="col-md-6">
        <?= $form->field($model, 'nome') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'cpf') ?>
    </div>
    <div class="col-md-2">            
        <?= $form->field($model, 'ativo')->dropDownList(['' => 'todos', '1' => 'ativo', '0' => 'inativo']) ?>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
