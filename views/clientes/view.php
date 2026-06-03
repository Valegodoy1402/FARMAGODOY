<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */

$this->title = $model->nombre . ' ' . $model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clientes-view d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">

        <div class="card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
            
            <div class="px-4 pt-4 pb-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
                <div>
                    <span class="badge text-uppercase mb-2" style="background-color: #d1f0ff; color: #029bf1; font-weight: 600; font-size: 0.75rem; padding: 5px 10px; border-radius: 4px;">Ficha de Cliente</span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
                        <?= Html::encode($this->title) ?>
                    </h2>
                    <p class="text-muted mb-0 small">ID Interno: <span class="font-monospace fw-medium">#<?= Html::encode($model->cliente_id) ?></span></p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <?= Html::a('✏️ Editar', ['update', 'cliente_id' => $model->cliente_id], [
                        'class' => 'btn fw-medium py-2 px-3',
                        'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.88rem; color: #475569; background-color: #ffffff;'
                    ]) ?>
                    
                    <?= Html::a('🗑️ Eliminar', ['delete', 'cliente_id' => $model->cliente_id], [
                        'class' => 'btn btn-outline-danger fw-medium py-2 px-3',
                        'style' => 'border-radius: 6px; font-size: 0.88rem;',
                        'data' => [
                            'confirm' => '¿Está completamente seguro de eliminar a este cliente del sistema?',
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
                            'attribute' => 'cliente_id',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; width: 30%; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'font-monospace px-4', 'style' => 'font-size: 0.92rem; color: #0c385a;'],
                        ],
                        [
                            'attribute' => 'nombre',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'fw-semibold text-dark px-4', 'style' => 'font-size: 0.95rem;'],
                        ],
                        [
                            'attribute' => 'apellido',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'fw-semibold text-dark px-4', 'style' => 'font-size: 0.95rem;'],
                        ],
                        [
                            'attribute' => 'dni_cedula',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'px-4 font-monospace', 'style' => 'font-size: 0.92rem; color: #1e293b;'],
                        ],
                        [
                            'attribute' => 'telefono',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'text-muted px-4', 'style' => 'font-size: 0.92rem;'],
                        ],
                        [
                            'attribute' => 'email',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'email',
                            'contentOptions' => ['class' => 'px-4 fw-medium', 'style' => 'font-size: 0.92rem; color: #029bf1;'],
                        ],
                    ],
                ]) ?>
            </div>

            <div class="card-footer p-3 bg-light bg-opacity-25 border-top d-flex justify-content-end">
                <?= Html::a('⬅️ Volver al Listado de Clientes', ['index'], [
                    'class' => 'btn btn-link text-decoration-none small font-weight-medium',
                    'style' => 'color: #475569; font-size: 0.9rem;'
                ]) ?>
            </div>
        </div>

    </div>
</div>