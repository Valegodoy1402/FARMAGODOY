<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Perfil: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">

        <div class="card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
            
            <div class="px-4 pt-4 pb-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid #029bf1; background-color: #f1f5f9;">
                        <?= $model->foto ? 
                            Html::img(Yii::getAlias('@web/') . $model->foto, ['style' => 'width:100%; height:100%; object-fit:cover;']) : 
                            '<div class="d-flex align-items-center justify-content-center h-100 text-muted fw-bold" style="font-size: 1.2rem; background: #e2e8f0;">' . strtoupper(substr($model->username, 0, 2)) . '</div>' 
                        ?>
                    </div>
                    <div>
                        <span class="badge text-uppercase mb-1" style="background-color: #d1f0ff; color: #029bf1; font-weight: 600; font-size: 0.75rem; padding: 5px 10px; border-radius: 4px;">Seguridad y Accesos</span>
                        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
                            <?= Html::encode($model->username) ?>
                        </h2>
                        <p class="text-muted mb-0 small">User ID Correlativo: <span class="font-monospace fw-medium">#<?= Html::encode($model->id) ?></span></p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <?= Html::a('✏️ Editar Cuenta', ['update', 'id' => $model->id], [
                        'class' => 'btn fw-medium py-2 px-3',
                        'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.88rem; color: #475569; background-color: #ffffff;'
                    ]) ?>
                    
                    <?= Html::a('🗑️ Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-outline-danger fw-medium py-2 px-3',
                        'style' => 'border-radius: 6px; font-size: 0.88rem;',
                        'data' => [
                            'confirm' => '¿Está completamente seguro de que desea eliminar este usuario del sistema?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card-body p-0">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table custom-table-modern mb-0 align-middle'],
                    'attributes' => [
                        [
                            'attribute' => 'id',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; width: 30%; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'font-monospace px-4', 'style' => 'font-size: 0.92rem; color: #0c385a;'],
                        ],
                        // NUEVA FILA: Vista previa detallada de la foto de perfil
                        [
                            'attribute' => 'foto',
                            'label' => 'Foto de Perfil',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4 py-3'],
                            'value' => function($model) {
                                if ($model->foto) {
                                    return Html::img(Yii::getAlias('@web/') . $model->foto, [
                                        'class' => 'img-thumbnail shadow-sm',
                                        'style' => 'max-width: 120px; max-height: 120px; object-fit: cover; border-radius: 8px;'
                                    ]);
                                }
                                return '<span class="text-muted italic" style="font-size: 0.9rem;">Sin foto de perfil asignada</span>';
                            }
                        ],
                        [
                            'attribute' => 'username',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'fw-bold text-dark px-4', 'style' => 'font-size: 0.95rem;'],
                        ],
                        [
                            'attribute' => 'password_hash',
                            'label' => 'Contraseña',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4'],
                            'value' => function($model) {
                                $passwordReal = $model->password_plain ?: 'No registrada';
                                return '
                                <div class="d-flex align-items-center justify-content-between gap-2 w-100">
                                    <div class="font-monospace text-truncate me-2" id="password-container" style="font-size: 0.95rem; max-width: 85%;">
                                        <span class="text-muted opacity-50" style="letter-spacing: 2px;">••••••••••••••••</span>
                                    </div>
                                    <button type="button" id="btn-toggle-password" class="btn btn-sm btn-light border d-flex align-items-center justify-content-center" 
                                            style="border-radius: 6px; padding: 6px 10px; min-width: 38px; color: #475569;" 
                                            data-real-password="' . Html::encode($passwordReal) . '" title="Mostrar/Ocultar Contraseña">
                                        <span id="eye-icon">👁️</span>
                                    </button>
                                </div>';
                            }
                        ],
                        [
                            'attribute' => 'auth_key',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4 text-muted font-monospace', 'style' => 'letter-spacing: 2px; font-size: 0.85rem; opacity: 0.6;'],
                            'value' => function($model) { return '••••••••••••••••'; }
                        ],
                        [
                            'attribute' => 'access_token',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'px-4 text-muted font-monospace', 'style' => 'font-size: 0.9rem;'],
                            'value' => function($model) { return $model->access_token ?: 'Ninguno asignado'; }
                        ],
                        [
                            'attribute' => 'role',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4'],
                            'value' => function ($model) {
                                $color = ($model->role === 'administrador') ? 'bg-primary text-primary' : 'bg-info text-info';
                                return '<span class="badge text-uppercase rounded-1 px-2 py-1 ' . $color . ' bg-opacity-10" style="font-size: 0.75rem; font-weight: 600;">' . Html::encode($model->role) . '</span>';
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4'],
                            'value' => function ($model) {
                                $statusLabel = ($model->status == 10) ? 'Activo' : 'Inactivo';
                                $statusClass = ($model->status == 10) ? 'bg-success text-success' : 'bg-danger text-danger';
                                return '<span class="badge rounded-1 px-2 py-1 ' . $statusClass . ' bg-opacity-10" style="font-size: 0.75rem; font-weight: 600;">' . $statusLabel . '</span>';
                            }
                        ],
                    ],
                ]) ?>
            </div>

            <div class="card-footer p-3 bg-light bg-opacity-25 border-top d-flex justify-content-end">
                <?= Html::a('⬅️ Volver a Lista de Usuarios', ['index'], [
                    'class' => 'btn btn-link text-decoration-none small font-weight-medium',
                    'style' => 'color: #475569; font-size: 0.9rem;'
                ]) ?>
            </div>
        </div>

    </div>
</div>

<?php
// Interactividad en tiempo de ejecución nativa
$js = <<<JS
document.getElementById('btn-toggle-password').addEventListener('click', function() {
    var container = document.getElementById('password-container');
    var icon = document.getElementById('eye-icon');
    var realPassword = this.getAttribute('data-real-password');
    
    if (container.querySelector('span')) {
        container.innerHTML = HtmlEncode(realPassword);
        container.style.letterSpacing = 'normal';
        container.classList.remove('text-muted', 'opacity-50');
        container.classList.add('text-dark', 'fw-bold');
        icon.textContent = '🙈';
    } else {
        container.innerHTML = '<span class="text-muted opacity-50" style="letter-spacing: 2px;">••••••••••••••••</span>';
        container.classList.remove('text-dark', 'fw-bold');
        icon.textContent = '👁️';
    }
});

function HtmlEncode(s) {
    var el = document.createElement("div");
    el.innerText = el.textContent = s;
    s = el.innerHTML;
    return s;
}
JS;
$this->registerJs($js);
?>