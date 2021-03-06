<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VeterinarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Veterinarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veterinario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-dismissable alert-info">
            <div class="row">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <p>
            <?= Html::a('Create Veterinario', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="col-md-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'rowOptions' => function($model) {
                if ($model->ativo == 0) {
                    return ['style' => 'background-color: #ffcccc'];
                }
            },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'nome',
                        'crmv',
                        [
                                'headerOptions' => ['class' => 'text-center', 'width' => '80'],
                                'attribute' => 'ativo',
                                'format' => 'raw',
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    if ($model->ativo) {
                                        return "<i class='glyphicon glyphicon-ok text-success'></i>";
                                    } else {
                                        return "<i class='glyphicon glyphicon-remove text-success'></i>";
                                    }
                                },
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
    </div>
</div>
