@extends('layouts.web')

@section('title', 'Contacto - Ferretería')
@section('description', 'Ponte en contacto con nosotros. Estamos aquí para ayudarte con tus proyectos de construcción y reparación.')

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
                        <span class="text-gray-500">Contacto</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Contact Section -->
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Contáctanos</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Estamos aquí para ayudarte con tus proyectos. No dudes en contactarnos 
            para cualquier consulta, cotización o asesoría técnica.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Contact Info -->
        <div class="lg:col-span-1">
            <div class="bg-orange-600 text-white rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Información de Contacto</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-xl mr-4 mt-1 text-orange-200"></i>
                        <div>
                            <h3 class="font-semibold mb-1">Dirección</h3>
                            <p class="text-orange-100">
                                Av. Principal 123<br>
                                Zona Centro, Ciudad<br>
                                CP 12345
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-phone text-xl mr-4 mt-1 text-orange-200"></i>
                        <div>
                            <h3 class="font-semibold mb-1">Teléfono</h3>
                            <p class="text-orange-100">+1 234 567 8900</p>
                            <p class="text-orange-100">+1 234 567 8901</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-xl mr-4 mt-1 text-orange-200"></i>
                        <div>
                            <h3 class="font-semibold mb-1">Email</h3>
                            <p class="text-orange-100">info@ferreteria.com</p>
                            <p class="text-orange-100">ventas@ferreteria.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-clock text-xl mr-4 mt-1 text-orange-200"></i>
                        <div>
                            <h3 class="font-semibold mb-1">Horario de Atención</h3>
                            <p class="text-orange-100">
                                Lunes - Viernes: 8:00 - 18:00<br>
                                Sábados: 8:00 - 14:00<br>
                                Domingos: Cerrado
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8 pt-8 border-t border-orange-500">
                    <h3 class="font-semibold mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-400 transition-colors">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-400 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-400 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-400 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Envíanos un Mensaje</h2>
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
                @endif
                
                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre Completo *
                            </label>
                            <input type="text" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('nombre') border-red-500 @enderror">
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                                Teléfono
                            </label>
                            <input type="tel" 
                                   id="telefono" 
                                   name="telefono" 
                                   value="{{ old('telefono') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('telefono') border-red-500 @enderror">
                            @error('telefono')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="asunto" class="block text-sm font-medium text-gray-700 mb-2">
                                Asunto
                            </label>
                            <select id="asunto" 
                                    name="asunto"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Selecciona un asunto</option>
                                <option value="consulta_general" {{ old('asunto') == 'consulta_general' ? 'selected' : '' }}>Consulta General</option>
                                <option value="cotizacion" {{ old('asunto') == 'cotizacion' ? 'selected' : '' }}>Solicitar Cotización</option>
                                <option value="soporte_tecnico" {{ old('asunto') == 'soporte_tecnico' ? 'selected' : '' }}>Soporte Técnico</option>
                                <option value="reclamo" {{ old('asunto') == 'reclamo' ? 'selected' : '' }}>Reclamo</option>
                                <option value="otro" {{ old('asunto') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-2">
                            Mensaje *
                        </label>
                        <textarea id="mensaje" 
                                  name="mensaje" 
                                  rows="6" 
                                  required
                                  placeholder="Cuéntanos cómo podemos ayudarte..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('mensaje') border-red-500 @enderror">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" 
                                   name="acepta_politicas" 
                                   required
                                   class="mt-1 text-orange-600 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-600">
                                Acepto la <a href="#" class="text-orange-600 hover:underline">política de privacidad</a> 
                                y el <a href="#" class="text-orange-600 hover:underline">tratamiento de datos</a> *
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-orange-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Additional Info -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-headset text-2xl text-orange-600"></i>
            </div>
            <h3 class="text-xl font-semibold mb-3">Asesoría Especializada</h3>
            <p class="text-gray-600">
                Nuestro equipo de expertos está listo para asesorarte en tu proyecto. 
                Contamos con más de 20 años de experiencia.
            </p>
        </div>
        
        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calculator text-2xl text-orange-600"></i>
            </div>
            <h3 class="text-xl font-semibold mb-3">Cotizaciones Gratuitas</h3>
            <p class="text-gray-600">
                Solicita cotizaciones sin compromiso. Te ayudamos a calcular 
                exactamente lo que necesitas para tu proyecto.
            </p>
        </div>
        
        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-truck text-2xl text-orange-600"></i>
            </div>
            <h3 class="text-xl font-semibold mb-3">Entregas a Domicilio</h3>
            <p class="text-gray-600">
                Servicio de entrega en toda la ciudad. Para proyectos grandes 
                ofrecemos descuentos especiales en el envío.
            </p>
        </div>
    </div>
    
    <!-- Map Section -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Nuestra Ubicación</h2>
        <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
            <!-- Aquí puedes integrar Google Maps o Mapbox -->
            <div class="text-center">
                <i class="fas fa-map-marker-alt text-4xl text-orange-600 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Av. Principal 123</h3>
                <p class="text-gray-600">Zona Centro, Ciudad</p>
                <a href="https://maps.google.com" target="_blank" 
                   class="inline-block mt-4 bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition-colors">
                    Ver en Google Maps
                </a>
            </div>
        </div>
    </div>
</div>
@endsection