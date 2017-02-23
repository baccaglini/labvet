<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProprietarioAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proprietario-animal-index">

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
            <?= Html::a('Novo Animal', ['create'], ['class' => 'btn btn-success']) ?>
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
                        ['attribute' => 'proprietario', 'value' => 'proprietario0.nome'],
                        'animal',
                        ['attribute' => 'raca', 'value' => 'raca0.raca'],
                        ['attribute' => 'especie', 'value' => 'raca0.especie0.especie'],
                        'sexo',
                        'cor',
                        // 'nascimento',
                        'obs:ntext',
                        // 'ativo',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
    </div>
</div>
