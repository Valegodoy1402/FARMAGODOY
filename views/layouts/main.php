<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 layout-custom-body">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="' . Url::to('@web/img/logo.png') . '" alt="FarmaciaGodoy" class="navbar-logo">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-light bg-white border-bottom fixed-top py-2 custom-navbar']
    ]);

    // Construcción dinámica del bloque del usuario autenticado con su Avatar circular
    $userMenu = '';
    if (!Yii::$app->user->isGuest) {
        $currentUser = Yii::$app->user->identity;
        
        // Comprobación de si tiene una foto cargada en la base de datos
        if (!empty($currentUser->foto)) {
            $userAvatar = Html::img('@web/' . $currentUser->foto, [
                'class' => 'rounded-circle',
                'style' => 'width: 30px; height: 30px; object-fit: cover; border: 1px solid #029bf1;'
            ]);
        } else {
            // Placeholder estético por defecto
            $userAvatar = '<div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-secondary fw-bold" style="width: 30px; height: 30px; font-size: 0.8rem; border: 1px solid #cbd5e1;">' . strtoupper(substr($currentUser->username, 0, 2)) . '</div>';
        }

        $userMenu = '<li class="nav-item ms-md-3 d-flex align-items-center gap-2 bg-light px-3 py-1.5" style="border-radius: 50px; border: 1px solid #e2e8f0;">'
            . $userAvatar
            . '<span class="small fw-semibold text-dark me-1">' . Html::encode($currentUser->username) . '</span>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline mb-0'])
            . Html::submitButton('Salir 🚪', ['class' => 'btn btn-link p-0 text-danger text-decoration-none small fw-medium', 'style' => 'font-size: 0.82rem;'])
            . Html::endForm()
            . '</li>';
    } else {
        $userMenu = ['label' => 'Login', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'btn btn-login-navbar text-white ms-md-3 px-4']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto align-items-center'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'nav-link-custom']],
            
            // 1. MENÚ DESPLEGABLE: GESTIÓN DE MEDICAMENTOS
            [
                'label' => 'Gestión de Medicamentos',
                'linkOptions' => ['class' => 'nav-link-custom'],
                'items' => [
                    ['label' => 'Catálogo de Medicamentos', 'url' => ['/medicamentos/index']],
                    ['label' => 'Registro de Clientes', 'url' => ['/clientes/index']],
                    '<hr class="dropdown-divider">',
                    ['label' => 'Control de Ventas', 'url' => ['/ventas/index']],
                ],
            ],

            // 2. BOTÓN SIMPLE: GESTIÓN DE USUARIOS
            ['label' => 'Gestión de Usuarios', 'url' => ['/user/index'], 'linkOptions' => ['class' => 'nav-link-custom']],
            
            // Renderizado del login o contenedor de avatar circular
            Yii::$app->user->isGuest ? $userMenu : $userMenu
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-5 custom-footer border-top">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="mb-3">
                    <img src="<?= Url::to('@web/img/logo.png') ?>" alt="FarmaciaGodoy" style="height: 35px; width: auto; object-fit: contain;">
                </div>
                <p class="text-muted small lh-lg" style="max-width: 320px;">
                    Tu farmacia de confianza, brindando cuidado y salud a la comunidad desde hace más de 20 años.
                </p>
            </div>
            <div class="col-6 col-md-3">
                <h6 class="fw-bold footer-heading text-uppercase mb-3">Enlaces</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4">
                <h6 class="fw-bold footer-heading text-uppercase mb-3">Legal</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Pharmacy Licensing</a></li>
                    <li><a href="#">Medical Advice Disclaimer</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 text-muted opacity-25">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="small text-muted mb-0">&copy; 2026 FarmaciaGodoy. All rights reserved. Powered by ClinicalSystems.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted mx-2 footer-social-icon">📍</a>
                <a href="#" class="text-muted mx-2 footer-social-icon">🔗</a>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>