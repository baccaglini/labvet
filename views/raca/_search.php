<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Especie;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\RacaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raca-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-6">    
        <?=
        $form->field($model, 'especie')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Especie::find()->where(['ativo' => 1])->all(), 'especie', 'especie'),
            'language' => 'pt-BR',
            'options' => ['placeholder' => 'Select a espécie ...'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'raca') ?>
    </div>
        <div class="form-group col-md-12 text-right">
            <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
