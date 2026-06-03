<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="clientes-form card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
    
    <div class="px-4 pt-4 pb-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
            <?= $model->isNewRecord ? 'Registrar Nuevo Cliente' : 'Modificar Ficha de Cliente' ?>
        </h2>
        <p class="text-muted mb-0 small">Asegúrese de ingresar correctamente el documento de identidad para la facturación y el historial de recetas.</p>
    </div>

    <div class="card-body p-4 pt-2">
        <?php $form = ActiveForm::begin([
            'id' => 'cliente-active-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label fw-semibold text-secondary small mb-1'],
                'inputOptions' => ['class' => 'form-control custom-form-input'],
                'errorOptions' => ['class' => 'invalid-feedback small mt-1'],
            ],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'nombre')->textInput([
                    'placeholder' => 'Ej: Juan Carlos',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'apellido')->textInput([
                    'placeholder' => 'Ej: Armijos Mendoza',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'dni_cedula')->textInput([
                    'placeholder' => 'Ej: 1726354890',
                    'maxlength' => true,
                    'inputmode' => 'numeric',
                    'pattern' => '[0-9]*'
                ])->label('DNI / Cédula') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'telefono')->textInput([
                    'type' => 'tel',
                    'placeholder' => 'Ej: 0998765432',
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-12">
                <?= $form->field($model, 'email')->textInput([
                    'type' => 'email',
                    'placeholder' => 'ejemplo@correo.com',
                    'maxlength' => true
                ])->label('Correo Electrónico') ?>
            </div>
        </div>

        <div class="alert alert-success d-flex align-items-center mt-4 border-0 p-3" style="background-color: #f0fdf4; color: #15803d; border-radius: 8px; font-size: 0.88rem;">
            <div class="me-2 fs-5 lh-1">ℹ️</div>
            <div>Los datos de contacto serán utilizados exclusivamente para el envío automatizado de comprobantes electrónicos de FarmaciaGodoy.</div>
        </div>

        <div class="form-group d-flex flex-column gap-2 mt-4">
            <?= Html::submitButton('Guardar Cliente', [
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