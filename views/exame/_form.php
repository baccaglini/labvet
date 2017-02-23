<?php

use app\models\Amostra;
use app\models\Exame;
use app\models\ExameAmostra;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Exame */
/* @var $modelsExameAmostra ExameAmostra */
/* @var $form ActiveForm */

$modelExameAmostra = new ExameAmostra();
$col_largura = 0;
if (!$model->isNewRecord) {
    $arrAux = array();
    foreach ($modelsExameAmostra as $modelExameAmostra) {
        if ($modelExameAmostra->ativo) {
            $arrAux[] = $modelExameAmostra->amostra;
        }
    }

    $modelExameAmostra->amostra = $arrAux;
    $col_largura = 3;
}
?>

<div class="exame-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($msg != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <strong>Erro!</strong><?= $msg; ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Exame</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'exame')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'valor')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'prazo')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-<?= (12 - $col_largura); ?>">
                    <?=
                    $form->field($modelExameAmostra, 'amostra')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Amostra::find()->where(['ativo' => 1])->all(), 'id', 'amostra'),
                        'language' => 'pt-BR',
                        'options' => ['placeholder' => 'Selecione a(s) amostra(s)...', 'multiple' => true],
                        'pluginOptions' => [
                            'tags' => true,
                        ]
                    ])->label('Amostra(s)');
                    ?>
                </div>
                <?php if (!$model->isNewRecord): ?>
                    <div class="col-md-<?= $col_largura; ?>">
                        <?= $form->field($model, 'ativo')->dropDownList([1 => 'Ativo', 0 => 'Inativo']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
