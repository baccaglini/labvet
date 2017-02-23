<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEmail */

$this->title = 'Update Clinica Email: ' . $model->clinica;
$this->params['breadcrumbs'][] = ['label' => 'Clinica Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clinica, 'url' => ['view', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clinica-email-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
