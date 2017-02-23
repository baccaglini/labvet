<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoExame */

$this->title = 'Create Atendimento Exame';
$this->params['breadcrumbs'][] = ['label' => 'Atendimento Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-exame-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
