<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página principal de la ferretería
Route::get('/', function () {
    return '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FerroMax - Tu Ferretería de Confianza</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            :root {
                --primary-color: #ff6b35;
                --secondary-color: #f7931e;
                --dark-color: #2c3e50;
                --light-bg: #f8f9fa;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                overflow-x: hidden;
            }

            /* Loader */
            .loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.8s, visibility 0.8s;
            }

            .loader.hidden {
                opacity: 0;
                visibility: hidden;
            }

            .loader-content {
                text-align: center;
                animation: fadeInUp 0.8s ease;
            }

            .loader-logo {
                font-size: 4rem;
                color: white;
                margin-bottom: 20px;
                animation: pulse 1.5s ease-in-out infinite;
            }

            .loader-text {
                color: white;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 30px;
                letter-spacing: 2px;
            }

            .loader-progress {
                width: 200px;
                height: 4px;
                background: rgba(255,255,255,0.3);
                border-radius: 2px;
                overflow: hidden;
                margin: 0 auto;
            }

            .loader-progress-bar {
                height: 100%;
                background: white;
                border-radius: 2px;
                animation: loadProgress 2s ease;
                animation-fill-mode: forwards;
            }

            .loader-tools {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                opacity: 0.1;
            }

            .loader-tool {
                position: absolute;
                font-size: 3rem;
                color: white;
                animation: floatLoader 4s infinite ease-in-out;
            }

            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
            }

            @keyframes loadProgress {
                0% {
                    width: 0%;
                }
                100% {
                    width: 100%;
                }
            }

            @keyframes floatLoader {
                0%, 100% {
                    transform: translateY(0) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(180deg);
                }
            }

            /* Navbar */
            .navbar {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                box-shadow: 0 2px 20px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            }

            .navbar.scrolled {
                padding: 0.5rem 0;
            }

            .navbar-brand {
                font-weight: bold;
                font-size: 1.5rem;
                color: var(--primary-color) !important;
            }

            .navbar-brand i {
                margin-right: 8px;
            }

            .nav-link {
                color: var(--dark-color) !important;
                font-weight: 500;
                margin: 0 10px;
                transition: all 0.3s ease;
                position: relative;
            }

            .nav-link::after {
                content: "";
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -5px;
                left: 50%;
                background-color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .nav-link:hover::after {
                width: 100%;
                left: 0;
            }

            /* Hero Section */
            .hero {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
            }

            .hero::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .hero-content {
                position: relative;
                z-index: 2;
            }

            .hero h1 {
                font-size: 4rem;
                font-weight: 800;
                margin-bottom: 1.5rem;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                animation: fadeInUp 1s ease;
            }

            .hero p {
                font-size: 1.5rem;
                margin-bottom: 2rem;
                animation: fadeInUp 1s ease 0.2s;
                animation-fill-mode: both;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .btn-hero {
                padding: 15px 40px;
                font-size: 1.1rem;
                font-weight: 600;
                border-radius: 50px;
                transition: all 0.3s ease;
                animation: fadeInUp 1s ease 0.4s;
                animation-fill-mode: both;
                text-decoration: none;
                display: inline-block;
                margin: 10px;
            }

            .btn-primary-hero {
                background: var(--primary-color);
                color: white;
                border: 2px solid var(--primary-color);
            }

            .btn-primary-hero:hover {
                background: transparent;
                color: white;
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            }

            .btn-outline-hero {
                background: transparent;
                color: white;
                border: 2px solid white;
            }

            .btn-outline-hero:hover {
                background: white;
                color: var(--primary-color);
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            }

            /* Floating Tools Animation */
            .floating-tools {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .tool {
                position: absolute;
                font-size: 2rem;
                color: rgba(255,255,255,0.1);
                animation: float 20s infinite linear;
            }

            @keyframes float {
                from {
                    transform: translateY(100vh) rotate(0deg);
                }
                to {
                    transform: translateY(-100vh) rotate(360deg);
                }
            }

            /* Services Section */
            .services {
                padding: 80px 0;
                background: var(--light-bg);
            }

            .section-title {
                font-size: 3rem;
                font-weight: 700;
                color: var(--dark-color);
                margin-bottom: 20px;
                position: relative;
                display: inline-block;
            }

            .section-title::after {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 2px;
            }

            .service-card {
                background: white;
                border-radius: 15px;
                padding: 40px 30px;
                text-align: center;
                transition: all 0.3s ease;
                height: 100%;
                box-shadow: 0 5px 20px rgba(0,0,0,0.08);
                position: relative;
                overflow: hidden;
            }

            .service-card::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .service-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            }

            .service-card:hover::before {
                transform: scaleX(1);
            }

            .service-icon {
                font-size: 3.5rem;
                color: var(--primary-color);
                margin-bottom: 20px;
                transition: all 0.3s ease;
            }

            .service-card:hover .service-icon {
                transform: scale(1.1) rotate(10deg);
            }

            /* Products Section */
            .products {
                padding: 80px 0;
            }

            .category-card {
                position: relative;
                height: 300px;
                border-radius: 15px;
                overflow: hidden;
                cursor: pointer;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            }

            .category-card:hover {
                transform: scale(1.05);
                box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            }

            .category-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 30px;
                color: white;
            }

            .category-card h3 {
                font-size: 1.8rem;
                font-weight: 700;
                margin-bottom: 10px;
            }

            /* Features Section */
            .features {
                padding: 80px 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                position: relative;
            }

            .feature-box {
                text-align: center;
                padding: 30px;
                border-radius: 15px;
                background: rgba(255,255,255,0.1);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            }

            .feature-box:hover {
                background: rgba(255,255,255,0.2);
                transform: translateY(-5px);
            }

            .feature-box i {
                font-size: 3rem;
                margin-bottom: 20px;
            }

            /* Stats Section */
            .stats {
                padding: 60px 0;
                background: var(--dark-color);
                color: white;
            }

            .stat-item {
                text-align: center;
            }

            .stat-number {
                font-size: 3rem;
                font-weight: 700;
                color: var(--primary-color);
            }

            /* Contact Section */
            .contact {
                padding: 80px 0;
                background: var(--light-bg);
            }

            .contact-info {
                background: white;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }

            .contact-item {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .contact-item i {
                font-size: 1.5rem;
                color: var(--primary-color);
                margin-right: 15px;
                width: 30px;
            }

            /* Footer */
            .footer {
                background: var(--dark-color);
                color: white;
                padding: 50px 0 30px;
            }

            .footer-widget h4 {
                color: var(--primary-color);
                margin-bottom: 20px;
            }

            .footer-links {
                list-style: none;
                padding: 0;
            }

            .footer-links li {
                margin-bottom: 10px;
            }

            .footer-links a {
                color: #bbb;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .footer-links a:hover {
                color: var(--primary-color);
                padding-left: 5px;
            }

            .social-icons a {
                display: inline-block;
                width: 40px;
                height: 40px;
                background: rgba(255,255,255,0.1);
                color: white;
                text-align: center;
                line-height: 40px;
                border-radius: 50%;
                margin-right: 10px;
                transition: all 0.3s ease;
            }

            .social-icons a:hover {
                background: var(--primary-color);
                transform: translateY(-3px);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .hero h1 {
                    font-size: 2.5rem;
                }
                
                .hero p {
                    font-size: 1.2rem;
                }

                .section-title {
                    font-size: 2rem;
                }

                .btn-hero {
                    padding: 12px 30px;
                    font-size: 1rem;
                }
            }

            /* Scroll to top button */
            .scroll-top {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                background: var(--primary-color);
                color: white;
                text-align: center;
                line-height: 50px;
                border-radius: 50%;
                cursor: pointer;
                opacity: 0;
                pointer-events: none;
                transition: all 0.3s ease;
                z-index: 1000;
            }

            .scroll-top.active {
                opacity: 1;
                pointer-events: all;
            }

            .scroll-top:hover {
                background: var(--secondary-color);
                transform: translateY(-5px);
            }
        </style>
    </head>
    <body>
        <!-- Loader -->
        <div class="loader">
            <div class="loader-tools">
                <i class="fas fa-hammer loader-tool" style="top: 10%; left: 15%; animation-delay: 0s;"></i>
                <i class="fas fa-wrench loader-tool" style="top: 20%; right: 20%; animation-delay: 0.5s;"></i>
                <i class="fas fa-screwdriver loader-tool" style="bottom: 30%; left: 10%; animation-delay: 1s;"></i>
                <i class="fas fa-drill loader-tool" style="bottom: 20%; right: 15%; animation-delay: 1.5s;"></i>
                <i class="fas fa-toolbox loader-tool" style="top: 50%; left: 80%; animation-delay: 2s;"></i>
            </div>
            <div class="loader-content">
                <div class="loader-logo">
                    <i class="fas fa-tools"></i>
                </div>
                <h1 class="loader-text">FerroMax</h1>
                <div class="loader-progress">
                    <div class="loader-progress-bar"></div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#home">
                    <i class="fas fa-tools"></i>FerroMax
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="/dashboard">
                                <i class="fas fa-cogs"></i> Admin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="floating-tools">
                <i class="fas fa-hammer tool" style="left: 10%; animation-delay: 0s;"></i>
                <i class="fas fa-wrench tool" style="left: 20%; animation-delay: 2s;"></i>
                <i class="fas fa-screwdriver tool" style="left: 30%; animation-delay: 4s;"></i>
                <i class="fas fa-drill tool" style="left: 40%; animation-delay: 6s;"></i>
                <i class="fas fa-toolbox tool" style="left: 50%; animation-delay: 8s;"></i>
                <i class="fas fa-hard-hat tool" style="left: 60%; animation-delay: 10s;"></i>
                <i class="fas fa-paint-roller tool" style="left: 70%; animation-delay: 12s;"></i>
                <i class="fas fa-ruler tool" style="left: 80%; animation-delay: 14s;"></i>
                <i class="fas fa-cog tool" style="left: 90%; animation-delay: 16s;"></i>
            </div>
            <div class="container hero-content">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6 text-white">
                        <h1>Tu Ferretería de Confianza</h1>
                        <p>Más de 25 años equipando tus proyectos con las mejores herramientas y materiales del mercado</p>
                        <div>
                            <a href="#products" class="btn-hero btn-primary-hero">
                                <i class="fas fa-shopping-cart"></i> Ver Productos
                            </a>
                            <a href="/dashboard" class="btn-hero btn-outline-hero">
                                <i class="fas fa-cogs"></i> Sistema Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services" id="services">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Nuestros Servicios</h2>
                    <p class="lead">Soluciones integrales para todos tus proyectos</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card">
                            <i class="fas fa-truck service-icon"></i>
                            <h3>Entrega a Domicilio</h3>
                            <p>Llevamos tus pedidos hasta la puerta de tu hogar o proyecto. Entrega rápida y segura en toda la ciudad.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <i class="fas fa-users service-icon"></i>
                            <h3>Asesoría Especializada</h3>
                            <p>Nuestro equipo de expertos te ayudará a elegir los mejores materiales y herramientas para tu proyecto.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <i class="fas fa-tools service-icon"></i>
                            <h3>Alquiler de Herramientas</h3>
                            <p>¿Necesitas una herramienta específica? Contamos con servicio de alquiler de equipos profesionales.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-card">
                            <i class="fas fa-paint-brush service-icon"></i>
                            <h3>Centro de Pinturas</h3>
                            <p>Mezclamos el color exacto que necesitas. Miles de tonalidades disponibles al instante.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-card">
                            <i class="fas fa-cut service-icon"></i>
                            <h3>Corte a Medida</h3>
                            <p>Cortamos madera, vidrio y otros materiales según tus especificaciones exactas.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-card">
                            <i class="fas fa-certificate service-icon"></i>
                            <h3>Garantía Extendida</h3>
                            <p>Ofrecemos garantía extendida en herramientas eléctricas y equipos profesionales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="products" id="products">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Categorías de Productos</h2>
                    <p class="lead">Todo lo que necesitas en un solo lugar</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%23ff6b35" width="400" height="300"/><path fill="%23fff" opacity="0.1" d="M0 150h400v150H0z"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Herramientas Eléctricas</h3>
                                <p>Taladros, sierras, lijadoras y más</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%23667eea" width="400" height="300"/><circle fill="%23fff" opacity="0.1" cx="200" cy="150" r="100"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Materiales de Construcción</h3>
                                <p>Cemento, arena, bloques y más</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%23764ba2" width="400" height="300"/><polygon fill="%23fff" opacity="0.1" points="200,50 350,250 50,250"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Pinturas y Acabados</h3>
                                <p>Pinturas, barnices, selladores</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%23f7931e" width="400" height="300"/><rect fill="%23fff" opacity="0.1" x="50" y="50" width="300" height="200"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Plomería</h3>
                                <p>Tubos, llaves, accesorios</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%232c3e50" width="400" height="300"/><path fill="%23fff" opacity="0.1" d="M0 0h200v300H0z"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Electricidad</h3>
                                <p>Cables, interruptores, luminarias</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="600">
                        <div class="category-card" style="background: url(\'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><rect fill="%2334495e" width="400" height="300"/><circle fill="%23fff" opacity="0.1" cx="100" cy="100" r="50"/><circle fill="%23fff" opacity="0.1" cx="300" cy="200" r="50"/></svg>\') center/cover;">
                            <div class="category-overlay">
                                <h3>Jardinería</h3>
                                <p>Herramientas y productos para jardín</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="about">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title text-white">¿Por qué elegirnos?</h2>
                    <p class="lead">Ventajas que marcan la diferencia</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-box">
                            <i class="fas fa-award"></i>
                            <h4>Calidad Garantizada</h4>
                            <p>Trabajamos solo con las mejores marcas del mercado</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-box">
                            <i class="fas fa-dollar-sign"></i>
                            <h4>Mejores Precios</h4>
                            <p>Precios competitivos y ofertas especiales cada semana</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-box">
                            <i class="fas fa-clock"></i>
                            <h4>Atención Rápida</h4>
                            <p>Personal capacitado para atenderte sin demoras</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <h4>Compra Segura</h4>
                            <p>Garantía de satisfacción en todas tus compras</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-md-3" data-aos="zoom-in">
                        <div class="stat-item">
                            <div class="stat-number" data-count="25">0</div>
                            <p>Años de Experiencia</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                        <div class="stat-item">
                            <div class="stat-number" data-count="50000">0</div>
                            <p>Clientes Satisfechos</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
                        <div class="stat-item">
                            <div class="stat-number" data-count="10000">0</div>
                            <p>Productos en Stock</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="600">
                        <div class="stat-item">
                            <div class="stat-number" data-count="98">0</div>
                            <p>% Satisfacción</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact" id="contact">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Contáctanos</h2>
                    <p class="lead">Estamos aquí para ayudarte con tu proyecto</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="contact-info">
                            <h3 class="mb-4">Información de Contacto</h3>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h5>Dirección</h5>
                                    <p>Av. Principal #123, Centro Comercial Plaza, Local 45</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <h5>Teléfono</h5>
                                    <p>+1 234 567 8900</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h5>Email</h5>
                                    <p>info@ferromax.com</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <h5>Horario</h5>
                                    <p>Lun-Vie: 8:00 AM - 7:00 PM<br>Sáb: 8:00 AM - 5:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8" data-aos="fade-left">
                        <form class="contact-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-lg" placeholder="Nombre completo" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control form-control-lg" placeholder="Teléfono">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control form-control-lg">
                                        <option value="">Selecciona un servicio</option>
                                        <option>Compra de productos</option>
                                        <option>Asesoría técnica</option>
                                        <option>Cotización especial</option>
                                        <option>Reclamos</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control form-control-lg" rows="5" placeholder="Mensaje" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="footer-widget">
                            <h3 class="text-white mb-3">
                                <i class="fas fa-tools"></i> FerroMax
                            </h3>
                            <p>Tu ferretería de confianza desde 1998. Comprometidos con la calidad y el servicio para hacer realidad todos tus proyectos.</p>
                            <div class="social-icons mt-4">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-widget">
                            <h4>Enlaces Rápidos</h4>
                            <ul class="footer-links">
                                <li><a href="#home">Inicio</a></li>
                                <li><a href="#services">Servicios</a></li>
                                <li><a href="#products">Productos</a></li>
                                <li><a href="#about">Nosotros</a></li>
                                <li><a href="#contact">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-widget">
                            <h4>Servicios</h4>
                            <ul class="footer-links">
                                <li><a href="#">Entrega a domicilio</a></li>
                                <li><a href="#">Asesoría técnica</a></li>
                                <li><a href="#">Alquiler de herramientas</a></li>
                                <li><a href="#">Corte a medida</a></li>
                                <li><a href="#">Garantías</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-widget">
                            <h4>Newsletter</h4>
                            <p>Suscríbete para recibir ofertas exclusivas y novedades</p>
                            <form class="mt-3">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Tu email">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="my-4 bg-secondary">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; 2024 FerroMax. Todos los derechos reservados Juan David Casanova Baron.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="/dashboard" class="text-warning text-decoration-none">
                            <i class="fas fa-cogs"></i> Sistema Administrativo
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to top button -->
        <div class="scroll-top" id="scrollTop">
            <i class="fas fa-arrow-up"></i>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true
            });

            // Loader
            window.addEventListener("load", function() {
                // Simular tiempo de carga para ver el efecto completo
                setTimeout(function() {
                    document.querySelector(".loader").classList.add("hidden");
                    // Iniciar animaciones después de cargar
                    document.body.style.overflow = "visible";
                }, 2500);
            });

            // Ocultar scroll durante la carga
            document.body.style.overflow = "hidden";
            
            // Cuando se oculte el loader, permitir scroll
            setTimeout(function() {
                document.body.style.overflow = "visible";
            }, 2500);

            // Navbar scroll effect
            window.addEventListener("scroll", function() {
                const navbar = document.querySelector(".navbar");
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }

                // Scroll to top button
                const scrollTop = document.getElementById("scrollTop");
                if (window.scrollY > 300) {
                    scrollTop.classList.add("active");
                } else {
                    scrollTop.classList.remove("active");
                }
            });

            // Smooth scrolling
            document.querySelectorAll(\'a[href^="#"]\').forEach(anchor => {
                anchor.addEventListener("click", function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute("href"));
                    if (target) {
                        target.scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        });
                    }
                });
            });

            // Scroll to top
            document.getElementById("scrollTop").addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });

            // Counter animation
            const counters = document.querySelectorAll(".stat-number");
            const speed = 200;

            const countUp = (counter) => {
                const target = +counter.getAttribute("data-count");
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => countUp(counter), 1);
                } else {
                    counter.innerText = target;
                    if (counter.innerText.includes("98")) {
                        counter.innerText += "%";
                    }
                }
            };

            // Intersection Observer for counter
            const observerOptions = {
                threshold: 0.5
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        countUp(counter);
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => {
                observer.observe(counter);
            });

            // Form handling
            document.querySelector(".contact-form").addEventListener("submit", function(e) {
                e.preventDefault();
                alert("¡Gracias por contactarnos! Te responderemos pronto.");
                this.reset();
            });

            // Newsletter form
            document.querySelector(".footer-widget form").addEventListener("submit", function(e) {
                e.preventDefault();
                alert("¡Gracias por suscribirte a nuestro newsletter!");
                this.reset();
            });
        </script>
    </body>
    </html>
    ';
});

// Ruta para ir al sistema Filament
Route::get('/sistema', function () {
    return redirect('/dashboard');
});

// Ruta de contacto mejorada
Route::get('/contacto', function () {
    return redirect('/#contact');
});