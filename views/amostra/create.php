<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Amostra */

$this->title = 'Create Amostra';
$this->params['breadcrumbs'][] = ['label' => 'Amostras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amostra-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
