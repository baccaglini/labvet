<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Especie */
/* @var $form yii\widgets\ActiveForm */

$col_largura = 0;
if (!$model->isNewRecord) {
    $col_largura = 3;
}
?>

<div class="especie-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Adicionar Espécie</h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-<?= (12 - $col_largura); ?>">
                    <?= $form->field($model, 'especie')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-3">
                    <?php if (!$model->isNewRecord): ?>
                        <?= $form->field($model, 'ativo')->dropDownList([1 => 'Ativo', 0 => 'Inativo']) ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
