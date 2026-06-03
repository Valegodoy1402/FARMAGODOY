<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Medicamentos $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="medicamentos-form card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
    
    <div class="px-4 pt-4 pb-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
            <?= $model->isNewRecord ? 'Registrar Nuevo Medicamento' : 'Actualizar Medicamento: ' . $model->nombre_comercial ?>
        </h2>
        <p class="text-muted mb-0 small">Ingrese las especificaciones técnicas, lote, precio e imagen para el inventario corporativo</p>
    </div>

    <div class="card-body p-4 pt-2">
        <?php $form = ActiveForm::begin([
            'id' => 'medicamento-active-form',
            'options' => ['enctype' => 'multipart/form-data'], // CRUCIAL PARA LA SUBIDA DE IMÁGENES
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label fw-semibold text-secondary small mb-1'],
                'inputOptions' => ['class' => 'form-control custom-form-input'],
                'errorOptions' => ['class' => 'invalid-feedback small mt-1'],
            ],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'nombre_comercial')->textInput([
                    'placeholder' => 'Ej: Paracetamol 500mg',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'componente_activo')->textInput([
                    'placeholder' => 'Ej: Acetaminofén',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'laboratorio')->textInput([
                    'placeholder' => 'Ej: Bayer Healthcare',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'precio')->textInput([
                    'type' => 'number',
                    'step' => '0.01',
                    'min' => '0',
                    'placeholder' => '$ 0.00'
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'stock')->textInput([
                    'type' => 'number',
                    'min' => '0',
                    'placeholder' => '0',
                ])->label('Stock Disponible') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'fecha_vencimiento')->textInput([
                    'type' => 'date',
                    'class' => 'form-control custom-form-input date-picker-custom'
                ]) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'imageFile')->fileInput([
                    'class' => 'form-control',
                    'accept' => 'image/*'
                ]) ?>
                <?php if (!$model->isNewRecord && $model->imagen): ?>
                    <div class="mt-2 p-2 border rounded d-inline-block bg-light">
                        <p class="small text-muted mb-1">Imagen Actual:</p>
                        <?= Html::img('@web/' . $model->imagen, ['class' => 'img-thumbnail', 'style' => 'max-height: 80px;']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="alert alert-success d-flex align-items-center mt-4 border-0 p-3" style="background-color: #f0fdf4; color: #15803d; border-radius: 8px; font-size: 0.88rem;">
            <div class="me-2 fs-5 lh-1">ℹ️</div>
            <div>Formatos admitidos: JPG, JPEG y PNG. El tamaño máximo recomendado es de 2MB por fotografía.</div>
        </div>

        <div class="form-group d-flex flex-column gap-2 mt-4">
            <?= Html::submitButton('Guardar Medicamento', [
                'class' => 'btn w-100 text-white fw-medium py-2.5 border-0 btn-save-form',
                'style' => 'background-color: #029bf1; border-radius: 6px; font-size: 0.95rem; padding: 10px;'
            ]) ?>
            
            <?= Html::a('Cancelar y Volver al Inventario', ['index'], [
                'class' => 'btn w-100 btn-cancel-form bg-transparent fw-medium py-2.5 text-center',
                'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; color: #475569; padding: 10px;'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>