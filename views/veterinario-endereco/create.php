<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VeterinarioEndereco */

$this->title = 'Create Veterinario Endereco';
$this->params['breadcrumbs'][] = ['label' => 'Veterinario Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veterinario-endereco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
