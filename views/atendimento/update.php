<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atendimento */

$this->title = 'Update Atendimento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atendimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atendimento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsAtendimentoExame' => $modelsAtendimentoExame,
        'msg' => $msg,
    ]) ?>

</div>
