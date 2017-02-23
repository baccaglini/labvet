<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clinica */

$this->title = 'Update Clinica: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clinicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clinica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelEndereco' => $modelEndereco,
        'modelsEmail' => $modelsEmail,
        'modelsFone' => $modelsFone,
        'msg' => $msg,
    ])
    ?>

</div>
