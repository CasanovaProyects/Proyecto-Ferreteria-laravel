@extends('layouts.web')

@section('title', $producto->nombre . ' - Ferretería')
@section('description', Str::limit($producto->descripcion, 160))

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600">
                        <i class="fas fa-home mr-2"></i>Inicio
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('productos') }}" class="text-gray-700 hover:text-orange-600">Productos</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500">{{ Str::limit($producto->nombre, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Images -->
        <div>
            <div class="bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="{{ $producto->nombre }}" 
                     class="w-full h-96 object-cover">
            </div>
            
            <!-- Thumbnail Gallery -->
            <div class="grid grid-cols-4 gap-2">
                @for($i = 1; $i <= 4; $i++)
                <div class="bg-gray-100 rounded cursor-pointer border-2 hover:border-orange-500 transition-colors">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                         alt="Vista {{ $i }}" 
                         class="w-full h-20 object-cover rounded">
                </div>
                @endfor
            </div>
        </div>
        
        <!-- Product Info -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $producto->nombre }}</h1>
            
            <!-- Rating -->
            <div class="flex items-center mb-4">
                <div class="flex text-yellow-400 mr-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-gray-600">(4.5) - 23 reseñas</span>
            </div>
            
            <!-- Price -->
            <div class="mb-6">
                @if($producto->precio_anterior && $producto->precio_anterior > $producto->precio)
                <div class="flex items-center space-x-3 mb-2">
                    <span class="text-2xl text-gray-400 line-through">${{ number_format($producto->precio_anterior, 2) }}</span>
                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                        -{{ round((($producto->precio_anterior - $producto->precio) / $producto->precio_anterior) * 100) }}%
                    </span>
                </div>
                @endif
                <span class="text-4xl font-bold text-orange-600">${{ number_format($producto->precio, 2) }}</span>
            </div>
            
            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Descripción</h3>
                <p class="text-gray-600 leading-relaxed">{{ $producto->descripcion }}</p>
            </div>
            
            <!-- Features -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Características</h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span class="text-gray-600">Alta calidad y durabilidad</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span class="text-gray-600">Garantía de 1 año</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span class="text-gray-600">Envío gratis en pedidos +$100</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span class="text-gray-600">Soporte técnico incluido</span>
                    </li>
                </ul>
            </div>
            
            <!-- Stock -->
            <div class="mb-6">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-box text-green-500"></i>
                    <span class="text-green-600 font-medium">En stock - Disponible para envío inmediato</span>
                </div>
            </div>
            
            <!-- Add to Cart -->
            <div class="mb-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center border border-gray-300 rounded">
                        <button class="px-3 py-2 hover:bg-gray-100">-</button>
                        <input type="number" value="1" min="1" class="w-16 px-3 py-2 text-center border-l border-r border-gray-300">
                        <button class="px-3 py-2 hover:bg-gray-100">+</button>
                    </div>
                    <span class="text-gray-600">unidades</span>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button class="flex-1 bg-orange-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Agregar al Carrito
                    </button>
                    <button class="bg-gray-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition-colors">
                        <i class="fas fa-heart mr-2"></i>
                        Favoritos
                    </button>
                </div>
            </div>
            
            <!-- Buy Now -->
            <button class="w-full bg-gray-800 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-900 transition-colors mb-6">
                Comprar Ahora
            </button>
            
            <!-- Additional Info -->
            <div class="border-t pt-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div>
                        <i class="fas fa-truck text-2xl text-orange-600 mb-2"></i>
                        <p class="text-sm font-medium">Envío Gratis</p>
                        <p class="text-xs text-gray-600">En pedidos +$100</p>
                    </div>
                    <div>
                        <i class="fas fa-undo text-2xl text-orange-600 mb-2"></i>
                        <p class="text-sm font-medium">Devoluciones</p>
                        <p class="text-xs text-gray-600">30 días</p>
                    </div>
                    <div>
                        <i class="fas fa-shield-alt text-2xl text-orange-600 mb-2"></i>
                        <p class="text-sm font-medium">Garantía</p>
                        <p class="text-xs text-gray-600">1 año</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabs Section -->
    <div class="mt-16">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button class="tab-button active border-b-2 border-orange-500 py-2 px-1 text-orange-600 font-medium" data-tab="description">
                    Descripción Detallada
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="specifications">
                    Especificaciones
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-gray-500 hover:text-gray-700" data-tab="reviews">
                    Reseñas (23)
                </button>
            </nav>
        </div>
        
        <!-- Tab Content -->
        <div class="mt-8">
            <div id="description" class="tab-content">
                <div class="prose max-w-none">
                    <p class="text-gray-600 leading-relaxed">
                        {{ $producto->descripcion }}
                    </p>
                    <p class="text-gray-600 leading-relaxed mt-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>
            
            <div id="specifications" class="tab-content hidden">
                <div class="bg-white rounded-lg border border-gray-200">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 bg-gray-50">Marca</td>
                                <td class="px-6 py-4 text-gray-600">Marca Premium</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 bg-gray-50">Modelo</td>
                                <td class="px-6 py-4 text-gray-600">MP-2024</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 bg-gray-50">Peso</td>
                                <td class="px-6 py-4 text-gray-600">2.5 kg</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 bg-gray-50">Dimensiones</td>
                                <td class="px-6 py-4 text-gray-600">30 x 15 x 10 cm</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 bg-gray-50">Material</td>
                                <td class="px-6 py-4 text-gray-600">Acero inoxidable</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="reviews" class="tab-content hidden">
                <div class="space-y-6">
                    <!-- Review Summary -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Calificación promedio</h3>
                            <div class="text-right">
                                <div class="text-3xl font-bold">4.5</div>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <div class="text-sm text-gray-600">Basado en 23 reseñas</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Individual Reviews -->
                    <div class="space-y-4">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-semibold text-orange-600">U{{ $i }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium">Usuario {{ $i }}</div>
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">Hace {{ $i }} días</span>
                            </div>
                            <p class="text-gray-600">
                                Excelente producto, muy buena calidad. Lo recomiendo totalmente. 
                                El envío fue rápido y el empaque perfecto.
                            </p>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($productosRelacionados->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Productos Relacionados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($productosRelacionados as $relacionado)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         alt="{{ $relacionado->nombre }}" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 group-hover:text-orange-600">
                        <a href="{{ route('producto.detalle', $relacionado->id) }}">{{ $relacionado->nombre }}</a>
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-orange-600">${{ number_format($relacionado->precio, 2) }}</span>
                        <a href="{{ route('producto.detalle', $relacionado->id) }}" 
                           class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition-colors">
                            Ver
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-orange-500', 'text-orange-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active class to clicked button and show content
            this.classList.add('active', 'border-orange-500', 'text-orange-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            document.getElementById(targetTab).classList.remove('hidden');
        });
    });
});
</script>
@endsection
@endsection