<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Medicamentos $model */

$this->title = $model->nombre_comercial;
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medicamentos-view d-flex justify-content-center py-4">
    <div class="w-100" style="max-width: 960px;"> <div class="card shadow-sm border-0 bg-white" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
            
            <div class="px-4 pt-4 pb-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
                <div>
                    <span class="badge text-uppercase mb-2 custom-badge" style="background-color: #d1f0ff; color: #029bf1; font-weight: 600; font-size: 0.75rem; padding: 5px 10px; border-radius: 4px;">Ficha Técnica</span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; color: #0c385a !important;">
                        <?= Html::encode($this->title) ?>
                    </h2>
                    <p class="text-muted mb-0 small">Código de registro único: <span class="font-monospace fw-medium"><?= Html::encode($model->medicamento_id) ?></span></p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <?= Html::a('✏️ Editar', ['update', 'medicamento_id' => $model->medicamento_id], [
                        'class' => 'btn fw-medium py-2 px-3',
                        'style' => 'border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.88rem; color: #475569; background-color: #ffffff;'
                    ]) ?>
                    
                    <?= Html::a('🗑️ Eliminar', ['delete', 'medicamento_id' => $model->medicamento_id], [
                        'class' => 'btn btn-outline-danger fw-medium py-2 px-3',
                        'style' => 'border-radius: 6px; font-size: 0.88rem;',
                        'data' => [
                            'confirm' => '¿Está seguro de que desea eliminar permanentemente este medicamento del inventario? Se borrará su registro e imagen física.',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="row g-0">
                    
                    <div class="col-md-8 border-end" style="border-color: #e2e8f0 !important;">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table custom-table-modern mb-0 align-middle'],
                            'attributes' => [
                                [
                                    'attribute' => 'medicamento_id',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; width: 35%; letter-spacing: 0.5px;'],
                                    'contentOptions' => ['class' => 'font-monospace px-4', 'style' => 'font-size: 0.92rem; color: #0c385a;'],
                                ],
                                [
                                    'attribute' => 'nombre_comercial',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'contentOptions' => ['class' => 'fw-bold text-dark px-4', 'style' => 'font-size: 0.95rem;'],
                                ],
                                [
                                    'attribute' => 'componente_activo',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'contentOptions' => ['class' => 'text-muted fst-italic px-4', 'style' => 'font-size: 0.92rem;'],
                                ],
                                [
                                    'attribute' => 'laboratorio',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'format' => 'raw',
                                    'contentOptions' => ['class' => 'px-4'],
                                    'value' => function ($model) {
                                        return '<span class="badge rounded-1 px-2 py-1 text-uppercase text-success bg-opacity-10 bg-success" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.3px;">' . Html::encode($model->laboratorio) . '</span>';
                                    }
                                ],
                                [
                                    'attribute' => 'precio',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'contentOptions' => ['class' => 'fw-bold px-4', 'style' => 'color: #029bf1; font-size: 1rem;'],
                                    'value' => function ($model) {
                                        return '$' . number_format($model->precio, 2);
                                    }
                                ],
                                [
                                    'attribute' => 'stock',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'format' => 'raw',
                                    'contentOptions' => ['class' => 'px-4'],
                                    'value' => function ($model) {
                                        $badgeClass = ($model->stock > 10) ? 'bg-opacity-10 bg-secondary text-dark' : 'bg-opacity-10 bg-danger text-danger';
                                        return '<span class="badge rounded-1 px-2 py-1 ' . $badgeClass . '" style="font-size: 0.85rem; font-weight: 600;">' . Html::encode($model->stock) . ' unidades</span>';
                                    }
                                ],
                                [
                                    'attribute' => 'fecha_vencimiento',
                                    'captionOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4 bg-light bg-opacity-50', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                                    'contentOptions' => ['class' => 'text-muted px-4', 'style' => 'font-size: 0.9rem;'],
                                    'value' => function ($model) {
                                        return $model->fecha_vencimiento ? date('d/m/Y', strtotime($model->fecha_vencimiento)) : '-';
                                    }
                                ],
                            ],
                        ]) ?>
                    </div>

                    <div class="col-md-4 d-flex align-items-center justify-content-center bg-light bg-opacity-25 p-4 text-center">
                        <div class="w-100">
                            <p class="text-uppercase text-muted fw-bold small mb-3" style="font-size: 0.7rem; letter-spacing: 1px;">Imagen de Inventario</p>
                            <?php if (!empty($model->imagen)): ?>
                                <?= Html::img('@web/' . $model->imagen, [
                                    'class' => 'img-fluid shadow-sm',
                                    'style' => 'max-height: 240px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; background-color: #ffffff; padding: 8px;'
                                ]) ?>
                            <?php else: ?>
                                <div class="d-flex flex-column align-items-center justify-content-center border border-dashed p-5" style="border-radius: 8px; background-color: #ffffff; min-height: 200px; border-style: dashed !important; border-color: #cbd5e1 !important;">
                                    <span style="font-size: 2.5rem; opacity: 0.7;">📦</span>
                                    <span class="text-muted small mt-2 d-block">Sin imagen cargada</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer p-3 bg-light bg-opacity-25 border-top d-flex justify-content-end">
                <?= Html::a('⬅️ Volver al Listado Completo', ['index'], [
                    'class' => 'btn btn-link text-decoration-none small font-weight-medium',
                    'style' => 'color: #475569; font-size: 0.9rem;'
                ]) ?>
            </div>
        </div>

    </div>
</div>