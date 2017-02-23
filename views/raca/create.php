<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Raca */

$this->title = 'Create Raca';
$this->params['breadcrumbs'][] = ['label' => 'Racas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raca-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
