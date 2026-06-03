<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Medicamentos $model */

$this->title = 'Modificar Medicamento: ' . $model->nombre_comercial;
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->medicamento_id, 'url' => ['view', 'medicamento_id' => $model->medicamento_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="medicamentos-update d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>