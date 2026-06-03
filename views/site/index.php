<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'FarmaciaGodoy - Tu Salud y Bienestar, Nuestra Prioridad';
?>

<div class="hero-section py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="badge text-uppercase mb-3 custom-badge">Compromiso con tu salud</span>
            <h1 class="display-4 fw-bold main-title mb-3">
                Tu Salud y Bienestar,<br><span class="text-primary-custom">Nuestra Prioridad</span>
            </h1>
            <p class="lead text-muted mb-4 subtitle-text">
                Encuentra medicamentos, productos de cuidado personal y suplementos con la calidad y atención que mereces. Atendemos tus necesidades con profesionalismo.
            </p>
            <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                <a href="#" class="btn btn-primary-custom btn-lg px-4 me-md-2">Explorar Catálogo / Productos</a>
                <a href="#" class="btn btn-outline-custom btn-lg px-4">Consultar Farmacéutico</a>
            </div>
        </div>
        <div class="col-lg-6 text-center position-relative">
            <div class="hero-image-container">
                <img src="<?= Url::to('@web/img/logo.png') ?>" alt="Farmacia Godoy Logo" class="img-fluid hero-logo-display mb-3" style="max-height: 80px;">
                <p class="text-muted small">Bienvenido a nuestra nueva plataforma optimizada.</p>
            </div>
        </div>
    </div>
</div>

<hr class="my-5 line-separator">

<div class="specialties-section text-center py-4">
    <h2 class="section-title position-relative mb-5 pb-3">Nuestras Especialidades</h2>
    
    <div class="row g-4 mt-2">
        <div class="col-lg-4">
            <div class="card h-100 specialty-card p-4">
                <div class="icon-wrapper mb-3 mx-auto text-primary-custom bg-light-blue">
                    <svg xmlns="http://www.w3.org/2000/ajax/libs/svg2" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                        <path d="M8.5 4.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L7 6l-.549.317a.5.5 0 1 0 .5.866l.549-.317V7.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L9 6l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V4.5z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 02 2h8a2 2 0 0 02-2zM9.5 1A1.5 1.5 0 0 1 11 2.5v2h2v9.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5V2a.5.5 0 0 1 .5-.5h5.5z"/>
                    </svg>
                </div>
                <h4 class="card-title fw-bold mb-3">Medicamentos bajo Receta</h4>
                <p class="card-text text-muted flex-grow-1">
                    Sube tu receta médica de forma segura o busca los fármacos autorizados que necesitas para tu tratamiento. Validación rápida por nuestros expertos.
                </p>
                <a href="#" class="btn btn-card-action mt-3">Buscar Medicamentos</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100 specialty-card p-4">
                <div class="icon-wrapper mb-3 mx-auto text-primary-custom bg-light-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-pulse" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                </div>
                <h4 class="card-title fw-bold mb-3">Cuidado y Belleza</h4>
                <p class="card-text text-muted flex-grow-1">
                    Explora nuestra gama de productos dermatológicos, cremas, higiene y cuidado diario para toda la familia. Las mejores marcas internacionales.
                </p>
                <a href="#" class="btn btn-card-action mt-3">Ver Productos</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100 specialty-card p-4">
                <div class="icon-wrapper mb-3 mx-auto text-primary-custom bg-light-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
                        <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.193-4.478-4.95 4.95 1.414 1.414 4.95-4.95-1.414-1.414Zm-6.364 6.364 1.414 1.414-4.95 4.95-1.414-1.414 4.95-4.95Z"/>
                    </svg>
                </div>
                <h4 class="card-title fw-bold mb-3">Suplementos y Vitaminas</h4>
                <p class="card-text text-muted flex-grow-1">
                    Potencia tu energía y refuerza tus defensas con nuestra selección de marcas líderes en nutrición y bienestar. Asesoría personalizada.
                </p>
                <a href="#" class="btn btn-card-action mt-3">Ver Suplementos</a>
            </div>
        </div>
    </div>
</div>

<div class="features-bar py-5 mt-5 border-top">
    <div class="row text-center g-4">
        <div class="col-6 col-md-3">
            <div class="feature-item">
                <div class="feature-icon text-primary-custom mb-2">🚚</div>
                <h6 class="fw-bold mb-1">Envío Gratis</h6>
                <p class="small text-muted mb-0">En compras +$500</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="feature-item">
                <div class="feature-icon text-primary-custom mb-2">🛡️</div>
                <h6 class="fw-bold mb-1">100% Certificados</h6>
                <p class="small text-muted mb-0">Productos originales</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="feature-item">
                <div class="feature-icon text-primary-custom mb-2">🎧</div>
                <h6 class="fw-bold mb-1">Atención 24/7</h6>
                <p class="small text-muted mb-0">Vía chat y teléfono</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="feature-item">
                <div class="feature-icon text-primary-custom mb-2">🏪</div>
                <h6 class="fw-bold mb-1">Retiro Local</h6>
                <p class="small text-muted mb-0">En menos de 1 hora</p>
            </div>
        </div>
    </div>
</div>