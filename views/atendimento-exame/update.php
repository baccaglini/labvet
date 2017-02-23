<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoExame */

$this->title = 'Update Atendimento Exame: ' . $model->atendimento;
$this->params['breadcrumbs'][] = ['label' => 'Atendimento Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->atendimento, 'url' => ['view', 'atendimento' => $model->atendimento, 'exame' => $model->exame]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atendimento-exame-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
