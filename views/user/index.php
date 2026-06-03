<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;

// Guardamos si es administrador para no repetir la validación tantas veces
$isAdmin = isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role === 'administrador';
?>
<div class="user-index">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="fw-bold text-dark mb-1" style="font-size: 1.85rem; color: #0c385a !important;">
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-muted mb-0 small">Control de accesos, credenciales y cuentas del sistema de FarmaciaGodoy</p>
        </div>
        <div>
            <?php // El botón de crear solo se muestra si el usuario es administrador ?>
            <?php if ($isAdmin): ?>
                <?= Html::a('<span class="me-1">+</span> Agregar Usuario', ['create'], [
                    'class' => 'btn text-white px-4 py-2 fw-medium border-0 btn-add-custom',
                    'style' => 'background-color: #029bf1; border-radius: 6px; font-size: 0.9rem;'
                ]) ?>
            <?php endif; ?>
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
                        'attribute' => 'id',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px; width: 80px;'],
                        'contentOptions' => ['style' => 'font-size: 0.9rem; color: #4a5568; font-weight: 500;'],
                    ],
                    [
                        'attribute' => 'username',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!empty($model->foto)) {
                                $avatar = Html::img('@web/' . $model->foto, [
                                    'class' => 'rounded-circle shadow-sm',
                                    'style' => 'width: 32px; height: 32px; object-fit: cover; border: 1px solid #cbd5e1;'
                                ]);
                            } else {
                                $iconColor = ($model->id % 2 === 0) ? '#e0f2fe' : '#e0f2fe';
                                $textColor = ($model->id % 2 === 0) ? '#029bf1' : '#0c385a';
                                $avatar = '<span class="badge rounded-circle p-2" style="background-color: '.$iconColor.'; color: '.$textColor.'; font-size: 0.85rem; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">👤</span>';
                            }
                            return '<div class="d-flex align-items-center gap-2">' 
                                        . $avatar . 
                                        '<span class="fw-semibold text-dark" style="font-size: 0.92rem;">' . Html::encode($model->username) . '</span>
                                    </div>';
                        }
                    ],
                    [
                        'attribute' => 'password_hash',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            return '<span class="text-muted tracking-widest font-monospace small" style="opacity: 0.5; letter-spacing: 2px;">••••••••</span>';
                        }
                    ],
                    [
                        'attribute' => 'role',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            $badgeClass = ($model->role === 'administrador') ? 'bg-primary bg-opacity-10 text-primary' : 'bg-info bg-opacity-10 text-info';
                            return '<span class="badge text-uppercase ' . $badgeClass . '" style="font-size:0.75rem;">' . Html::encode($model->role) . '</span>';
                        }
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'ACCIONES',
                        'headerOptions' => ['class' => 'text-uppercase text-muted fw-bold text-center px-4', 'style' => 'font-size: 0.75rem; letter-spacing: 0.5px; width: 140px; min-width: 140px;'],
                        'contentOptions' => ['class' => 'px-4', 'style' => 'white-space: nowrap; text-align: center;'],
                        // Controlamos la visibilidad individual de los botones basándonos en si es administrador
                        'visibleButtons' => [
                            'view' => $isAdmin,
                            'update' => $isAdmin,
                            'delete' => $isAdmin,
                        ],
                        'urlCreator' => function ($action, User $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
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
                                        'confirm' => '¿Estás seguro de que deseas eliminar este usuario?',
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