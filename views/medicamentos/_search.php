<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MedicamentosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medicamentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'medicamento_id') ?>

    <?= $form->field($model, 'nombre_comercial') ?>

    <?= $form->field($model, 'componente_activo') ?>

    <?= $form->field($model, 'laboratorio') ?>

    <?= $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'fecha_vencimiento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
