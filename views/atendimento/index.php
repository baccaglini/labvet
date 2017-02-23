<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtendimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atendimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Atendimento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'proprietario',
            'sequencia',
            'veterinario',
            'clinica',
            // 'usuario',
            // 'cadastro',
            // 'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/
    
    echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'rowOptions' => function($model) {
                if ($model->ativo == 0) {
                    return ['style' => 'background-color: #ffcccc'];
                }
            },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'proprietario', 'value' => 'proprietario0.nome'],
                        ['attribute' => 'animal', 'value' => 'animal0.animal'],
                        ['attribute' => 'raca', 'value' => 'animal0.raca0.raca'],
                        ['attribute' => 'veterinario', 'value' => 'veterinario0.nome'],
                        'cadastro',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
    
    ?>
</div>
