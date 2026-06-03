<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="user-form card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
    
    <div class="px-4 pt-4 pb-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
            <?= $model->isNewRecord ? 'Crear Cuenta de Usuario' : 'Actualizar Credenciales' ?>
        </h2>
        <p class="text-muted mb-0 small">Asigne un nombre de usuario único, foto de perfil, contraseña segura y defina el nivel de privilegios dentro del sistema.</p>
    </div>

    <div class="card-body p-4 pt-2">
        <?php $form = ActiveForm::begin([
            'id' => 'user-active-form',
            'options' => ['enctype' => 'multipart/form-data'], // Esencial para la foto
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label fw-semibold text-secondary small mb-1'],
                'inputOptions' => ['class' => 'form-control custom-form-input'],
                'errorOptions' => ['class' => 'invalid-feedback small mt-1'],
            ],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $form->field($model, 'username')->textInput([
                            'placeholder' => 'Ej: lmero_farmacia',
                            'maxlength' => true
                        ])->label('Nombre de Usuario (Login)') ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'password')->passwordInput([
                            'placeholder' => $model->isNewRecord ? 'Asignar contraseña' : 'Dejar en blanco para no cambiar',
                            'maxlength' => true,
                            'value' => '' 
                        ])->label($model->isNewRecord ? 'Contraseña' : 'Nueva Contraseña (Opcional)') ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'role')->dropDownList(
                            [ 'administrador' => 'Administrador', 'operador' => 'Operador' ],
                            [
                                'prompt' => '--- Seleccionar Rol ---',
                                'class' => 'form-select custom-form-input'
                            ]
                        )->label('Rol del Sistema') ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'status')->dropDownList(
                            [ 10 => 'Activo / Habilitado', 0 => 'Inactivo / Suspendido' ],
                            [ 'class' => 'form-select custom-form-input' ]
                        )->label('Estado de Cuenta') ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center border-start ps-3" style="border-color: #e2e8f0 !important;">
                <label class="form-label fw-semibold text-secondary small mb-2 text-center w-100">Foto de Perfil</sol>
                <div class="mb-3 text-center">
                    <?php if (!$model->isNewRecord && !empty($model->foto)): ?>
                        <?= Html::img('@web/' . $model->foto, ['class' => 'rounded-circle shadow-sm object-cover', 'style' => 'width: 100px; height: 100px; object-fit: cover; border: 2px solid #029bf1;']) ?>
                    <?php else: ?>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px; font-size: 2.2rem; color: #cbd5e1; border: 2px dashed #cbd5e1;">👤</div>
                    <?php endif; ?>
                </div>
                <?= $form->field($model, 'imageFile')->fileInput(['class' => 'form-control form-control-sm'])->label(false) ?>
            </div>
        </div>

        <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'access_token')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>

        <div class="alert alert-success d-flex align-items-center mt-4 border-0 p-3" style="background-color: #f0fdf4; color: #15803d; border-radius: 8px; font-size: 0.88rem;">
            <div class="me-2 fs-5 lh-1">🔒</div>
            <div>Las contraseñas son encriptadas automáticamente mediante algoritmos de hash seguro antes de ser almacenadas.</div>
        </div>

        <div class="form-group d-flex flex-column gap-2 mt-4">
            <?= Html::submitButton('Guardar Usuario', [
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