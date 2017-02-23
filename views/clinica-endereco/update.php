<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEndereco */

$this->title = 'Update Clinica Endereco: ' . $model->clinica;
$this->params['breadcrumbs'][] = ['label' => 'Clinica Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clinica, 'url' => ['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clinica-endereco-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
