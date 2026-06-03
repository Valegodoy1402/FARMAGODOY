<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Medicamentos $model */

$this->title = 'Registrar Nuevo Medicamento';
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicamentos-create d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>