<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProprietarioAnimal */

$this->title = 'Update Proprietario Animal: ' . $model->proprietario;
$this->params['breadcrumbs'][] = ['label' => 'Proprietario Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->proprietario, 'url' => ['view', 'proprietario' => $model->proprietario, 'sequencia' => $model->sequencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proprietario-animal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'msg' => $msg,
    ]) ?>

</div>
