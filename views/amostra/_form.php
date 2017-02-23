<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Amostra */
/* @var $form yii\widgets\ActiveForm */

$col_largura = 0;
if (!$model->isNewRecord) {
    $col_largura = 3;
}
?>

<div class="amostra-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Adicionar Amostra</h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-<?= (12 - $col_largura); ?>">
                    <?= $form->field($model, 'amostra')->textInput(['maxlength' => true]) ?>
                </div>
                <?php if (!$model->isNewRecord): ?>
                    <div class="col-md-<?= $col_largura; ?>">
                        <?= $form->field($model, 'ativo')->dropDownList([1 => 'Ativo', 0 => 'Inativo']) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-right">
                        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
