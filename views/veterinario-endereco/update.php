<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VeterinarioEndereco */

$this->title = 'Update Veterinario Endereco: ' . $model->veterinario;
$this->params['breadcrumbs'][] = ['label' => 'Veterinario Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->veterinario, 'url' => ['view', 'id' => $model->veterinario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="veterinario-endereco-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
