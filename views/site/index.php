<?php
/* @var $this yii\web\View */

use scotthuangzl\googlechart\GoogleChart;

$this->title = 'My Yii Application';

$aux[] = ['Especies', 'Atendimentos'];
foreach ($resp as $value) {
    $aux[] = array($value['especie'], (int) $value['qtd']);
}
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>LabVet!</h1>
        <!--p class="lead">texto texto texto texto texto texto</p-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
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
        </div>
    </div>
</div>
