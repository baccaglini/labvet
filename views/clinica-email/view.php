<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEmail */

$this->title = $model->clinica;
$this->params['breadcrumbs'][] = ['label' => 'Clinica Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinica-email-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'clinica' => $model->clinica, 'sequencia' => $model->sequencia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'clinica',
            'sequencia',
            'email:email',
            'principal',
            'ativo',
        ],
    ]) ?>

</div>
