<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Veterinario */

$this->title = 'Update Veterinario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Veterinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="veterinario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelEndereco' => $modelEndereco,
        'modelsEmail' => $modelsEmail,
        'modelsFone' => $modelsFone,
        'modelsClinica' => $modelsClinica,
        'msg' => $msg,
    ])
    ?>

</div>
