<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Atendimento;
use app\models\Clinica;
use app\models\Exame;
use app\models\ExameAmostra;
use app\models\Proprietario;
use app\models\ProprietarioAnimal;
use app\models\Veterinario;

/* @var $this yii\web\View */
/* @var $model app\models\Atendimento */

$dataProprietario = Proprietario::findOne(['id' => $model->proprietario]);

$dataAnimal = ProprietarioAnimal::findOne(['proprietario' => $model->proprietario]);

$dataVeterinario = Veterinario::findOne(['id' => $model->veterinario]);

$dataClinica = Clinica::findOne(['id' => $model->clinica]);

$valorTotal = 0;

$date = date_create($model->cadastro);
$ano = date_format($date, "Y");

$this->title = date_format($date, "d/m/Y H:i:s");
$this->params['breadcrumbs'][] = ['label' => 'Atendimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="atendimento-view">

    <div class="row">
        <div class="col-md-6">
            <h1>Atendimento</h1>
        </div>
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Animal</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    Proprietário: <?php echo ($dataProprietario->nome); ?>
                </div>
                <div class="col-md-6">
                    Animal: <?php echo ($dataAnimal->animal); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="item panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Veterinário</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    Nome: <?php echo ($dataVeterinario->nome); ?>
                </div>
                <div class="col-md-4">
                    Clinica: <?php echo (isset($dataClinica->nome) ? $dataClinica->nome : 'Não Informado'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="item panel panel-primary">  
        <div class="panel-heading">
            <h3 class="panel-title">Exames</h3>
        </div>
        <div class="panel-body">
            <table class="table" id="tblListaExames" >
                <thead>
                    <tr>
                        <th>Cod. Laudo</th>
                        <th>Exame</th>
                        <th>Amostra</th>
                        <th>Coleta</th>
                        <th>Valor</th>
                        <th>Liberação</th>
                        <th>Obs.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($modelsAtendimentoExame) > 0): ?>
                        <?php foreach ($modelsAtendimentoExame as $key => $value): ?>
                            <?php
                            if (is_null($value['liberacao'])) {
                                $dataFormatada = 'NÃO INFORMADO';
                            } else {
                                $dateLib = date_create($value['liberacao']);
                                $dataFormatada = date_format($dateLib, "d/m/Y");
                            }
                            ?>
                            <tr>
                                <td><?= ($value['laudo'] <> 0) ? $ano . str_pad($value['laudo'], 5, "0", STR_PAD_LEFT) : ''; ?></td>
                                <td><?= $value['exame']; ?></td>
                                <td><?= $value['amostra']; ?></td>
                                <td><?= $value['coleta']; ?></td>
                                <td><?= number_format($value['valor'], 2, ',', '.'); ?></td>
                                <td><?= $dataFormatada; ?></td>
                                <td><?= $value['obs']; ?></td>
                            </tr>
                            <?php $valorTotal += $value['valor']; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot style="background-color: #CCCCCC;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td><?php echo(number_format($valorTotal, 2, ',', '.')); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
