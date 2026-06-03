<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */

$this->title = 'Registrar Nuevo Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>