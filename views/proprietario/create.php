<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proprietario */

$this->title = 'Novo Proprietário';
$this->params['breadcrumbs'][] = ['label' => 'Proprietarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proprietario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelEndereco' => $modelEndereco,
        'modelsEmail' => $modelsEmail,
        'modelsFone' => $modelsFone,
        'modelsAnimal' => $modelsAnimal,
        'msg' => $msg,
    ])
    ?>

</div>
