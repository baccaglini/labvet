<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProprietarioAnimal */

$this->title = $model->proprietario;
$this->params['breadcrumbs'][] = ['label' => 'Proprietario Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proprietario-animal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'proprietario' => $model->proprietario, 'sequencia' => $model->sequencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'proprietario' => $model->proprietario, 'sequencia' => $model->sequencia], [
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
            'proprietario',
            'sequencia',
            'animal',
            'raca',
            'sexo',
            'cor',
            'nascimento',
            'obs:ntext',
            'ativo',
        ],
    ]) ?>

</div>
