<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administradors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Administrador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'cpf',
            'nome',
            'email:email',
            'senha',
            // 'ativo',
            // 'adm',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],
        ],
    ]);
    ?>

</div>
