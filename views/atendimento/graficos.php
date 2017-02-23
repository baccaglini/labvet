<?php

use app\models\AtendimentoSearch;
use scotthuangzl\googlechart\GoogleChart;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel AtendimentoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Atendimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $aux[] = ['Especies', 'Atendimentos'];
    foreach ($resp as $value) {
        $aux[] = array($value['especie'], (int) $value['qtd']);
    }

    $auxPorMes[] = array('Mês', 'Atendimentos');
    foreach ($porMes as $value) {
        $auxPorMes[] = array($value['mes'] . '/' . $value['ano'], (int) $value['qtd']);
    }
    ?>

    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Atendimento x Especie</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        GoogleChart::widget(array('visualization' => 'PieChart',
                            'data' => $aux,
                            'options' => ['title' => '']));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Atendimento x Mês <sub>(últimos 12 meses)</sub></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        GoogleChart::widget([
                            'visualization' => 'LineChart',
                            'data' => $auxPorMes,
                            'options' => [
                                'title' => '',
                                'legend' => ['position' => 'none'],
                                'pointSize' => 5,
                                'colors' => ['#0066cc'],
                            ],
                                ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
