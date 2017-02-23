<?php

use app\models\Especie;
use app\models\Raca;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Raca */
/* @var $form ActiveForm */

$col_largura = 0;
if (!$model->isNewRecord) {
    $col_largura = 2;
}
?>

<div class="raca-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Adicionar Espécie</h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-<?= (6 - $col_largura); ?>">
                    <?=
                    $form->field($model, 'especie')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Especie::find()->where(['ativo' => 1])->all(), 'id', 'especie'),
                        'language' => 'pt-BR',
                        'options' => ['placeholder' => 'Select a espécie ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'raca')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
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
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
