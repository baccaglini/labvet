<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProprietarioAnimalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proprietario-animal-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-4">
        <?= $form->field($model, 'proprietario') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'animal') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'sexo')->dropDownList(['' => 'todos', 'M' => 'Masculino', 'F' => 'Feminino']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'raca') ?>
    </div>    
    
    <?php // echo $form->field($model, 'cor') ?>

    <?php // echo $form->field($model, 'nascimento') ?>

    <?php // echo $form->field($model, 'obs') ?>

    <?php // echo $form->field($model, 'ativo')  ?>

    <div class="form-group col-md-12 text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
