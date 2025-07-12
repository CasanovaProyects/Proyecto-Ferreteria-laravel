@extends('layouts.web')

@section('title', 'Inicio - Ferretería')

@section('content')
<div class="hero-section mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold text-primary">
                Bienvenido a tu Ferretería
            </h1>
            <p class="lead">
                Encuentra las mejores herramientas y materiales para todos tus proyectos.
                Calidad garantizada y los mejores precios del mercado.
            </p>
            <div class="d-flex gap-3">
                <a href="{{ route('productos') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-cart"></i> Ver Productos
                </a>
                <a href="{{ route('sistema') }}" class="btn btn-outline-warning btn-lg">
                    <i class="fas fa-cogs"></i> Sistema Administrativo
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-orange-100 rounded-full p-8 text-center">
                <i class="fas fa-tools text-orange-600 fa-8x"></i>
            </div>
        </div>
    </div>
</div>

@if(isset($productos) && $productos->count() > 0)
<section class="productos-destacados">
    <div class="text-center mb-5">
        <h2 class="text-2xl font-semibold mb-3">Productos Destacados</h2>
        <p class="text-gray-600">Descubre nuestros productos más populares</p>
    </div>
    
    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                         class="card-img-top" 
                         alt="{{ $producto->nombre }}"
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                         style="height: 200px;">
                        <i class="fas fa-image text-muted fa-3x"></i>
                    </div>
                @endif
                
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($producto->descripcion, 80) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">
                            ${{ number_format($producto->precio, 2) }}
                        </span>
                        <a href="{{ route('producto.detalle', $producto->id) }}" 
                           class="btn btn-outline-primary btn-sm">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('productos') }}" class="btn btn-primary">
            Ver Todos los Productos
        </a>
    </div>
</section>
@endif

<!-- Sección de servicios -->
<section class="services-section mt-5">
    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <div class="service-card p-4 h-100">
                <i class="fas fa-shipping-fast text-primary fa-3x mb-3"></i>
                <h4>Envío Rápido</h4>
                <p>Entregamos tus productos en tiempo récord</p>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="service-card p-4 h-100">
                <i class="fas fa-medal text-primary fa-3x mb-3"></i>
                <h4>Calidad Garantizada</h4>
                <p>Todos nuestros productos cuentan con garantía</p>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="service-card p-4 h-100">
                <i class="fas fa-headset text-primary fa-3x mb-3"></i>
                <h4>Soporte 24/7</h4>
                <p>Estamos aquí para ayudarte cuando lo necesites</p>
            </div>
        </div>
    </div>
</section>
@endsection