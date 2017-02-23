<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExameAmostra */

$this->title = 'Update Exame Amostra: ' . $model->exame;
$this->params['breadcrumbs'][] = ['label' => 'Exame Amostras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->exame, 'url' => ['view', 'exame' => $model->exame, 'amostra' => $model->amostra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exame-amostra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
