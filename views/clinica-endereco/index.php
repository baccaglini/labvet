<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClinicaEnderecoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clinica Enderecos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinica-endereco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Clinica Endereco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clinica',
            'sequencia',
            'principal',
            'cep',
            'cidade',
            // 'uf',
            // 'logradouro',
            // 'numero',
            // 'bairro',
            // 'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
