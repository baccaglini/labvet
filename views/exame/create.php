<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exame */

$this->title = 'Create Exame';
$this->params['breadcrumbs'][] = ['label' => 'Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelsExameAmostra' => $modelsExameAmostra,
        'msg' => $msg,
    ])
    ?>

</div>
