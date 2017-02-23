<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Feriado */

$this->title = 'Create Feriado';
$this->params['breadcrumbs'][] = ['label' => 'Feriados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feriado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
