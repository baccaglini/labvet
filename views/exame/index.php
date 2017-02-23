<?php

use app\models\ExameSearch;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ExameSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Exames';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-index">

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
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Adcionar Exame', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'exame',
                        'valor',
                        'prazo',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
    </div>
</div>
