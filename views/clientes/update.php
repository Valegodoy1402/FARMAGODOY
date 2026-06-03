<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */

$this->title = 'Modificar Cliente: ' . $model->nombre . ' ' . $model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cliente_id, 'url' => ['view', 'cliente_id' => $model->cliente_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="clientes-update d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>