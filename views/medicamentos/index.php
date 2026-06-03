<?php

use app\models\Medicamentos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\MedicamentosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Medicamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicamentos-index">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="fw-bold text-dark mb-1" style="font-size: 1.85rem; color: #0c385a !important;">
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-muted mb-0 small">Inventario global de fármacos y productos de FarmaciaGodoy</p>
        </div>
        <div>
            <?= Html::a('<span class="me-1">+</span>Agregar Medicamento', ['create'], [
                'class' => 'btn text-white px-4 py-2 fw-medium border-0 btn-add-custom',
                'style' => 'background-color: #029bf1; border-radius: 6px; font-size: 0.9rem;'
            ]) ?>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <div class="card shadow-sm border-0 grid-card-custom" style="border-radius: 12px; background-color: #ffffff;">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table custom-table-modern align-middle mb-0'],
                'summary' => '<div class="summary-wrapper d-flex justify-content-between align-items-center px-4 py-3 border-bottom text-muted small">
                                <span>Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> elementos</span>
                                <div class="table-actions-icons">
                                    <span class="mx-2" style="cursor:pointer;">📊</span>
                                    <span style="cursor:pointer;">📥</span>
                                </div>
                              </div>',
                'pager' => [
                    'class' => \yii\bootstrap5\LinkPager::class,
                    'options' => ['class' => 'pagination pagination-sm m-0 px-4 py-3 border-top'],
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => '#',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold px-4', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px; width: 60px;'],
                        'contentOptions' => ['class' => 'text-muted px-4', 'style' => 'font-size: 0.9rem;'],
                    ],
                    [
                        'attribute' => 'medicamento_id',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px; width: 80px;'],
                        'contentOptions' => ['style' => 'font-size: 0.9rem; color: #4a5568; font-weight: 500;'],
                    ],
                    [
                        'attribute' => 'nombre_comercial',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            // Renderizado dinámico de la foto subida en la grilla principal
                            if (!empty($model->imagen)) {
                                $imgHtml = Html::img('@web/' . $model->imagen, [
                                    'style' => 'width: 36px; height: 36px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;'
                                ]);
                            } else {
                                $imgHtml = '<span class="badge rounded p-2" style="background-color: #e0f2fe; color: #029bf1; font-size: 0.85rem;">💊</span>';
                            }
                            
                            return '<div class="d-flex align-items-center gap-3">
                                        ' . $imgHtml . '
                                        <span class="fw-semibold text-dark" style="font-size: 0.92rem;">' . Html::encode($model->nombre_comercial) . '</span>
                                    </div>';
                        }
                    ],
                    [
                        'attribute' => 'componente_activo',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'contentOptions' => ['class' => 'text-muted fst-italic', 'style' => 'font-size: 0.9rem;'],
                    ],
                    [
                        'attribute' => 'laboratorio',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            return '<span class="badge rounded-1 px-2 py-1 text-uppercase text-success bg-opacity-10 bg-success" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.3px;">' . Html::encode($model->laboratorio) . '</span>';
                        }
                    ],
                    [
                        'attribute' => 'precio',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'contentOptions' => ['class' => 'fw-bold', 'style' => 'color: #029bf1; font-size: 0.95rem;'],
                        'value' => function ($model) {
                            return '$' . number_format($model->precio, 2);
                        }
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'ACCIONES',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold text-center px-4', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px; width: 140px; min-width: 140px;'],
                        'contentOptions' => ['class' => 'px-4', 'style' => 'white-space: nowrap; text-align: center;'],
                        'urlCreator' => function ($action, Medicamentos $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'medicamento_id' => $model->medicamento_id]);
                        },
                        'template' => '<div class="d-flex align-items-center justify-content-center gap-2">{view} {update} {delete}</div>',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('👁️', $url, ['class' => 'text-decoration-none p-1', 'title' => 'Ver', 'style' => 'font-size: 1.1rem; opacity: 0.75; display: inline-block;']);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('✏️', $url, ['class' => 'text-decoration-none p-1', 'title' => 'Editar', 'style' => 'font-size: 1.1rem; opacity: 0.75; display: inline-block;']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('🗑️', $url, [
                                    'class' => 'text-decoration-none p-1 text-danger',
                                    'title' => 'Eliminar',
                                    'style' => 'font-size: 1.1rem; opacity: 0.75; display: inline-block;',
                                    'data' => [
                                        'confirm' => '¿Estás seguro de que deseas eliminar este medicamento? Se borrará también su foto del servidor.',
                                        'method' => 'post',
                                    ],
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>