<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */

$this->title = 'Modificar Registro de Venta: #' . $model->venta_id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->venta_id, 'url' => ['view', 'venta_id' => $model->venta_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="ventas-update d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>