<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */

$this->title = 'Registrar Nueva Venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-create d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>