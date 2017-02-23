<?php

use app\models\RacaSearch;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $searchModel RacaSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Raças';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raca-index">

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
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Adcionar Raça', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'raca',
                        ['attribute' => 'especie', 'value' => 'especie0.especie'],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
    </div>
</div>
