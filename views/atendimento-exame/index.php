<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtendimentoExameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atendimento Exames';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-exame-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Atendimento Exame', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'atendimento',
            'exame',
            'amostra',
            'coleta',
            'valor',
            // 'liberacao',
            // 'obs:ntext',
            // 'usuario',
            // 'cadastro',
            // 'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
