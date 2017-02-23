<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cidade */

$this->title = 'Create Cidade';
$this->params['breadcrumbs'][] = ['label' => 'Cidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cidade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
