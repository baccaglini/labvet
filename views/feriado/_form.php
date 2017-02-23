<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Feriado */
/* @var $form yii\widgets\ActiveForm */
use app\models\TipoFeriado;
use yii\helpers\ArrayHelper;
?>

<div class="feriado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'feriado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?=
    $form->field($model, 'tipo')->dropDownList(ArrayHelper::map(TipoFeriado::find()->all(), 'id', 'descricao'), [
        'prompt' => 'selecione um tipo'
    ])
    ?>
    
    <?= $form->field($model, 'ciclico')->dropDownList([1=> 'sim', 0=> 'não'],[
        'prompt' => 'selecione uma opção'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
