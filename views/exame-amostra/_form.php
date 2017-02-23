<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExameAmostra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exame-amostra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exame')->textInput() ?>

    <?= $form->field($model, 'amostra')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
