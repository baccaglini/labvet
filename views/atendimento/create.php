<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atendimento */

$this->title = 'Create Atendimento';
$this->params['breadcrumbs'][] = ['label' => 'Atendimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelsAtendimentoExame' => $modelsAtendimentoExame,
        'msg' => $msg,
    ])
    ?>

</div>
