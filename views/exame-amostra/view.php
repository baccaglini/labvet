<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ExameAmostra */

$this->title = $model->exame;
$this->params['breadcrumbs'][] = ['label' => 'Exame Amostras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-amostra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'exame' => $model->exame, 'amostra' => $model->amostra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'exame' => $model->exame, 'amostra' => $model->amostra], [
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
            'exame',
            'amostra',
            'ativo',
        ],
    ]) ?>

</div>
