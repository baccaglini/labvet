<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Especie */

$this->title = 'Create Especie';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especie-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
