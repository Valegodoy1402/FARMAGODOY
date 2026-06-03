<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */

$this->title = 'Comprobante de Venta #' . $model->venta_id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ventas-view d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 780px;">

        <div class="card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
            
            <div class="px-4 pt-4 pb-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
                <div>
                    <span class="badge text-uppercase mb-2" style="background-color: #d1f0ff; color: #029bf1; font-weight: 600; font-size: 0.75rem; padding: 5px 10px; border-radius: 4px;">Detalle de Transacción</span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
                        <?= Html::encode($this->title) ?>
                    </h2>
                    <p class="text-muted mb-0 small">Fecha contable registrada: <span class="fw-medium text-dark"><?= $model->fecha_venta ? date('d/m/Y H:i', strtotime($model->fecha_venta)) : '-' ?></span></p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <?= Html::a('✏️ Editar', ['update', 'venta_id' => $model->venta_id], [
                        'class' => 'btn fw-medium py-2 px-3',
                        'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.88rem; color: #475569; background-color: #ffffff;'
                    ]) ?>
                    
                    <?= Html::a('🗑️ Eliminar', ['delete', 'venta_id' => $model->venta_id], [
                        'class' => 'btn btn-outline-danger fw-medium py-2 px-3',
                        'style' => 'border-radius: 6px; font-size: 0.88rem;',
                        'data' => [
                            'confirm' => '¿Está seguro de que desea anular y eliminar permanentemente este registro de venta?',
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
                            'attribute' => 'venta_id',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; width: 30%; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'font-monospace px-4', 'style' => 'font-size: 0.92rem; color: #0c385a;'],
                        ],
                        [
                            'attribute' => 'cliente_id',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'px-4 fw-medium', 'style' => 'font-size: 0.92rem; color: #334155;'],
                            'value' => function($model) {
                                return $model->cliente ? $model->cliente->nombre . ' ' . $model->cliente->apellido . ' (ID: ' . $model->cliente_id . ')' : $model->cliente_id;
                            }
                        ],
                        [
                            'attribute' => 'medicamento_id',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'px-4 fw-semibold', 'style' => 'font-size: 0.92rem; color: #334155;'],
                            'value' => function($model) {
                                return $model->medicamento ? $model->medicamento->nombre_comercial . ' (ID: ' . $model->medicamento_id . ')' : $model->medicamento_id;
                            }
                        ],
                        [
                            'attribute' => 'cantidad',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'px-4'],
                            'value' => function ($model) {
                                return '<span class="badge rounded-1 px-2 py-1 bg-opacity-10 bg-secondary text-dark" style="font-size: 0.85rem; font-weight: 600;">' . Html::encode($model->cantidad) . ' u.</span>';
                            }
                        ],
                        [
                            'attribute' => 'precio_unitario',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'px-4 text-muted', 'style' => 'font-size: 0.92rem;'],
                            'value' => function ($model) {
                                return '$' . number_format($model->precio_unitario, 2);
                            }
                        ],
                        [
                            'attribute' => 'total_pago',
                            'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                            'contentOptions' => ['class' => 'fw-bold px-4', 'style' => 'color: #029bf1; font-size: 1.05rem;'],
                            'value' => function ($model) {
                                return '$' . number_format($model->total_pago, 2);
                            }
                        ],
                    ],
                ]) ?>
            </div>

            <div class="card-footer p-3 bg-light bg-opacity-25 border-top d-flex justify-content-end">
                <?= Html::a('⬅️ Volver al Historial de Ventas', ['index'], [
                    'class' => 'btn btn-link text-decoration-none small font-weight-medium',
                    'style' => 'color: #475569; font-size: 0.9rem;'
                ]) ?>
            </div>
        </div>

    </div>
</div>