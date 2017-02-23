<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $model app\models\CidadeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cidade-search">


    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-3">
        <?=
        $form->field($model, 'idEstado')->dropDownList(ArrayHelper::map(Estado::find()->orderBy('prioridade desc, sgEstado')->all(), 'nmEstado', 'sgEstado'), [
            'prompt' => 'todos',
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'nmCidades') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'prioridade')->dropDownList(['' => 'todos', '1' => 'prioritário', '0' => 'não prioritário']) ?>
    </div>
    <div class="form-group col-md-12 text-right">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
