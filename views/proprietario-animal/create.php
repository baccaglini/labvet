<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProprietarioAnimal */

$this->title = 'Novo Animal';
$this->params['breadcrumbs'][] = ['label' => 'Proprietario Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proprietario-animal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'msg' => $msg,
    ]) ?>

</div>
