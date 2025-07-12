@extends('layouts.web')

@section('title', 'Productos - Ferretería')
@section('description', 'Explora nuestro catálogo completo de herramientas, materiales de construcción y productos para el hogar.')

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
                        <span class="text-gray-500">Productos</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold mb-4">Filtros</h3>
                
                <form method="GET" action="{{ route('productos') }}">
                    <!-- Search -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Nombre del producto..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rango de Precio</label>
                        <div class="flex space-x-2">
                            <input type="number" name="precio_min" value="{{ request('precio_min') }}" 
                                   placeholder="Mín" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                            <input type="number" name="precio_max" value="{{ request('precio_max') }}" 
                                   placeholder="Máx" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categorías</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="categorias[]" value="herramientas" class="text-orange-600 focus:ring-orange-500">
                                <span class="ml-2 text-sm">Herramientas</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="categorias[]" value="materiales" class="text-orange-600 focus:ring-orange-500">
                                <span class="ml-2 text-sm">Materiales</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="categorias[]" value="electricidad" class="text-orange-600 focus:ring-orange-500">
                                <span class="ml-2 text-sm">Electricidad</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="categorias[]" value="plomeria" class="text-orange-600 focus:ring-orange-500">
                                <span class="ml-2 text-sm">Plomería</span>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-orange-600 text-white py-2 px-4 rounded-md hover:bg-orange-700 transition-colors">
                        Aplicar Filtros
                    </button>
                    
                    @if(request()->hasAny(['search', 'precio_min', 'precio_max', 'categorias']))
                    <a href="{{ route('productos') }}" class="w-full block text-center mt-2 text-gray-600 hover:text-orange-600">
                        Limpiar Filtros
                    </a>
                    @endif
                </form>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="lg:w-3/4">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        @if(isset($categoria))
                            Productos - {{ ucfirst($categoria) }}
                        @else
                            Todos los Productos
                        @endif
                    </h1>
                    <p class="text-gray-600">{{ $productos->total() }} productos encontrados</p>
                </div>
                
                <!-- Sort -->
                <div class="mt-4 sm:mt-0">
                    <select class="px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        <option>Ordenar por</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                        <option>Nombre A-Z</option>
                        <option>Más Populares</option>
                    </select>
                </div>
            </div>
            
            <!-- Products -->
            @if($productos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($productos as $producto)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="{{ $producto->nombre }}" 
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform">
                        
                        <!-- Badges -->
                        @if($producto->precio_anterior && $producto->precio_anterior > $producto->precio)
                        <span class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                            -{{ round((($producto->precio_anterior - $producto->precio) / $producto->precio_anterior) * 100) }}%
                        </span>
                        @endif
                        
                        <!-- Quick Actions -->
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-50 mb-2 block">
                                <i class="fas fa-heart text-gray-600 hover:text-red-500"></i>
                            </button>
                            <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-50 block">
                                <i class="fas fa-eye text-gray-600 hover:text-orange-600"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 group-hover:text-orange-600">
                            <a href="{{ route('producto.detalle', $producto->id) }}">{{ $producto->nombre }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($producto->descripcion, 100) }}</p>
                        
                        <!-- Rating -->
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(4.5)</span>
                        </div>
                        
                        <!-- Price and Actions -->
                        <div class="flex items-center justify-between">
                            <div>
                                @if($producto->precio_anterior && $producto->precio_anterior > $producto->precio)
                                <span class="text-gray-400 line-through text-sm block">${{ number_format($producto->precio_anterior, 2) }}</span>
                                @endif
                                <span class="text-xl font-bold text-orange-600">${{ number_format($producto->precio, 2) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-700 transition-colors">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <a href="{{ route('producto.detalle', $producto->id) }}" 
                                   class="bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700 transition-colors">
                                    Ver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $productos->links() }}
            </div>
            
            @else
            <!-- No products found -->
            <div class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No se encontraron productos</h3>
                <p class="text-gray-500 mb-4">Intenta ajustar tus filtros de búsqueda</p>
                <a href="{{ route('productos') }}" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition-colors">
                    Ver Todos los Productos
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection