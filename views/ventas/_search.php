<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'venta_id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'medicamento_id') ?>

    <?= $form->field($model, 'fecha_venta') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'precio_unitario') ?>

    <?php // echo $form->field($model, 'total_pago') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
