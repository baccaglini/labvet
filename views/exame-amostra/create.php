<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExameAmostra */

$this->title = 'Create Exame Amostra';
$this->params['breadcrumbs'][] = ['label' => 'Exame Amostras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-amostra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
