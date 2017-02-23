<?php
/* @var $model app\models\Atendimento */
?>


<table style="width: 100%">
    <?php foreach ($lstModelAtendimento as $model) : ?>
        <tr>
            <td colspan="4">
                <hr />
            </td>
        </tr>
        <tr>    
            <td colspan="4" style="font-size: 20px; background-color: #ffffcc">
                # <?= str_pad($model->id, 10, '0', STR_PAD_LEFT) . '/' . date("Y", strtotime($model->cadastro)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Proprietário:</strong><br />
                <?= $model->proprietario01->nome; ?>
            </td>
            <td>
                <strong>Animal:</strong><br />
                <?= $model->proprietario0->animal; ?> (
                <?= $model->proprietario0->raca0->especie0->especie; ?> | 
                <?= $model->proprietario0->raca0->raca; ?> | 
                <?= $model->proprietario0->sexo; ?>)
                </ul>
            </td>
            <td>
                <strong>Exame:</strong><br />
                <?= $model->exame01->exame; ?>
            </td>
            <td>
                <strong>Amostra:</strong><br />
                <?= $model->amostra01->amostra; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Veterinário:</strong><br />
                <?= $model->veterinario0->nome; ?>
            </td>
            <td colspan="2">
                <strong>Veterinário:</strong><br />
                <?= $model->clinica0->nome; ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Valor:</strong><br />
                <?= $model->valor; ?>
            </td>
            <td>
                <strong>Liberação:</strong><br />
                <?= $model->liberacao; ?>
            </td>
            <td colspan="2">
                <strong>Data:</strong><br />
                <?= $model->cadastro; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>