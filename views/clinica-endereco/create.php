<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClinicaEndereco */

$this->title = 'Create Clinica Endereco';
$this->params['breadcrumbs'][] = ['label' => 'Clinica Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinica-endereco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
