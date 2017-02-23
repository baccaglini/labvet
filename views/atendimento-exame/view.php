<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoExame */

$this->title = $model->atendimento;
$this->params['breadcrumbs'][] = ['label' => 'Atendimento Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-exame-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'atendimento' => $model->atendimento, 'exame' => $model->exame], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'atendimento' => $model->atendimento, 'exame' => $model->exame], [
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
            'atendimento',
            'exame',
            'amostra',
            'coleta',
            'valor',
            'liberacao',
            'obs:ntext',
            'usuario',
            'cadastro',
            'ativo',
        ],
    ]) ?>

</div>
