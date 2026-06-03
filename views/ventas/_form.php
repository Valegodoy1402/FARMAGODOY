<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Clientes;
use app\models\Medicamentos;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */
/** @var yii\bootstrap5\ActiveForm $form */

// Si es una nueva venta, preselecciona la fecha y hora actual automáticamente
if ($model->isNewRecord && empty($model->fecha_venta)) {
    $model->fecha_venta = date('Y-m-d\TH:i');
} else if (!empty($model->fecha_venta)) {
    $model->fecha_venta = date('Y-m-d\TH:i', strtotime($model->fecha_venta));
}
?>

<div class="ventas-form card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
    
    <div class="px-4 pt-4 pb-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
            <?= $model->isNewRecord ? 'Registrar Nueva Venta' : 'Modificar Registro de Venta' ?>
        </h2>
        <p class="text-muted mb-0 small">Seleccione los elementos de la lista desplegable para agilizar el proceso de facturación inmediata.</p>
    </div>

    <div class="card-body p-4 pt-2">
        <?php $form = ActiveForm::begin([
            'id' => 'venta-active-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label fw-semibold text-secondary small mb-1'],
                'inputOptions' => ['class' => 'form-select custom-form-input'], // Usa form-select para las flechitas de las listas
                'errorOptions' => ['class' => 'invalid-feedback small mt-1'],
            ],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'cliente_id')->dropDownList(
                    ArrayHelper::map(Clientes::find()->all(), 'cliente_id', function($cliente) {
                        return $cliente->nombre . ' ' . $cliente->apellido . ' (ID: ' . $cliente->cliente_id . ')';
                    }),
                    ['prompt' => '--- Seleccione el Cliente ---']
                )->label('Cliente') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'medicamento_id')->dropDownList(
                    ArrayHelper::map(Medicamentos::find()->where(['>', 'stock', 0])->all(), 'medicamento_id', function($med) {
                        return $med->nombre_comercial . ' - $' . number_format($med->precio, 2) . ' (Stock: ' . $med->stock . ')';
                    }),
                    ['prompt' => '--- Seleccione el Fármaco ---']
                )->label('Medicamento / Producto') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'fecha_venta')->textInput([
                    'type' => 'datetime-local',
                    'class' => 'form-control custom-form-input'
                ])->label('Fecha y Hora de Emisión') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'cantidad')->textInput([
                    'type' => 'number',
                    'min' => '1',
                    'placeholder' => 'Ej: 1',
                    'class' => 'form-control custom-form-input'
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'precio_unitario')->textInput([
                    'type' => 'number',
                    'step' => '0.01',
                    'min' => '0',
                    'placeholder' => '$ 0.00',
                    'class' => 'form-control custom-form-input'
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'total_pago')->textInput([
                    'type' => 'number',
                    'step' => '0.01',
                    'min' => '0',
                    'placeholder' => '$ 0.00',
                    'class' => 'form-control custom-form-input'
                ])->label('Total Neto Pagado') ?>
            </div>
        </div>

        <div class="alert alert-success d-flex align-items-center mt-4 border-0 p-3" style="background-color: #f0fdf4; color: #15803d; border-radius: 8px; font-size: 0.88rem;">
            <div class="me-2 fs-5 lh-1">ℹ️</div>
            <div>El sistema validará de forma automática si la cantidad solicitada no supera el stock remanente del lote actual seleccionado.</div>
        </div>

        <div class="form-group d-flex flex-column gap-2 mt-4">
            <?= Html::submitButton('Procesar Registro de Venta', [
                'class' => 'btn w-100 text-white fw-medium py-2.5 border-0 btn-save-form',
                'style' => 'background-color: #029bf1; border-radius: 6px; font-size: 0.95rem; padding: 10px;'
            ]) ?>
            
            <?= Html::a('Cancelar y Volver al Listado', ['index'], [
                'class' => 'btn w-100 btn-cancel-form bg-transparent fw-medium py-2.5 text-center',
                'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; color: #475569; padding: 10px;'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>