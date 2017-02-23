<?php

use app\models\Cidade;
use app\models\Estado;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Cidade */
/* @var $form ActiveForm */

$col_largura = 0;
if (!$model->isNewRecord) {
    $col_largura = 2;
}
?>

<div class="cidade-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Adicionar Cidade</h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'prioridade')->dropDownList([0 => 'Sem Prioridade', 1 => 'Prioritário']) ?>
                </div>
                <div class="col-md-3">
                    <?=
                    $form->field($model, 'idEstado')->dropDownList(ArrayHelper::map(Estado::find()->orderBy('prioridade desc, sgEstado')->all(), 'id', 'nmEstado'), [
                        'prompt' => '-- selecione o estado',
                    ]);
                    ?>
                </div>
                <div class="col-md-<?= (7 - $col_largura); ?>">
                    <?= $form->field($model, 'nmCidades')->textInput(['maxlength' => true]) ?>
                </div>
                <?php if (!$model->isNewRecord): ?>
                    <div class="col-md-<?= $col_largura; ?>">
                        <?= $form->field($model, 'flAtivo')->dropDownList([1 => 'Ativo', 0 => 'Inativo']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        As cidades com prioridade são as que aparecem no topo das listas de seleção.
                    </div>
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
