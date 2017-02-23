<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AmostraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="amostra-search">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="col-md-8">
        <?= $form->field($model, 'amostra') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ativo')->dropDownList(['' => 'todos', '1' => 'ativo', '0' => 'inativo']) ?>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
