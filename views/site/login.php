<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar Sesión';
?>

<div class="site-login d-flex align-items-center justify-content-center" style="min-height: 75vh; background: radial-gradient(circle at top right, #f4f9fd 0%, #ffffff 100%);">
    
    <div class="w-100" style="max-width: 440px;">
        <!-- Tarjeta Principal de Login -->
        <div class="card shadow border-0 bg-white" style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
            
            <!-- Cabecera de Identidad -->
            <div class="px-4 pt-5 pb-3 text-center" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
                <div class="mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #d1f0ff; color: #029bf1; border-radius: 50%; font-size: 1.8rem;">
                    🔐
                </div>
                <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
                    FarmaciaGodoy
                </h2>
                <p class="text-muted small mb-0">Ingrese sus credenciales autorizadas para acceder al panel de control.</p>
            </div>

            <!-- Cuerpo del Formulario -->
            <div class="card-body p-4 pt-2">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'form-label fw-semibold text-secondary small mb-1'],
                        'inputOptions' => ['class' => 'form-control custom-form-input', 'style' => 'padding: 10px 12px;'],
                        'errorOptions' => ['class' => 'invalid-feedback small mt-1'],
                    ],
                ]); ?>

                <!-- Campo: Usuario -->
                <div class="mb-3">
                    <?= $form->field($model, 'username')->textInput([
                        'autofocus' => true,
                        'placeholder' => 'Nombre de usuario',
                        'class' => 'form-control custom-form-input'
                    ])->label('Usuario') ?>
                </div>

                <!-- Campo: Contraseña -->
                <div class="mb-3">
                    <?= $form->field($model, 'password')->passwordInput([
                        'placeholder' => '••••••••••••',
                        'class' => 'form-control custom-form-input'
                    ])->label('Contraseña') ?>
                </div>

                <!-- Campo: Recordarme (Checkbox Estilizado) -->
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'class' => 'form-check-input me-2',
                        'labelOptions' => ['class' => 'form-check-label text-secondary small fw-medium', 'style' => 'user-select: none; cursor: pointer;'],
                        'template' => "<div class=\"form-check d-flex align-items-center min-height-0\">{input} {label}</div>\n{error}",
                    ])->label('Mantener sesión activa') ?>
                </div>

                <!-- Botón de Envío -->
                <div class="form-group mb-2">
                    <?= Html::submitButton('Ingresar al Sistema', [
                        'class' => 'btn w-100 text-white fw-medium py-2.5 border-0 btn-save-form',
                        'name' => 'login-button',
                        'style' => 'background-color: #029bf1; border-radius: 8px; font-size: 0.95rem; padding: 11px; letter-spacing: 0.3px; transition: background 0.2s ease;'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <!-- Pie de Tarjeta / Información de Seguridad -->
            <div class="card-footer bg-light bg-opacity-50 border-top text-center py-3">
                <span class="text-muted" style="font-size: 0.78rem;">
                    Sistema de Gestión Protegido &copy; <?= date('Y') ?>
                </span>
            </div>
        </div>
    </div>

</div>