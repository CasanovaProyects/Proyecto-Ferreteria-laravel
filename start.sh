#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel + Filament en Render..."

# Esperar a que PostgreSQL esté disponible
echo "⏳ Esperando conexión a base de datos..."
timeout=60
while ! php artisan migrate:status > /dev/null 2>&1; do
    echo "Esperando base de datos... ($timeout segundos restantes)"
    sleep 5
    timeout=$((timeout-5))
    if [ $timeout -le 0 ]; then
        echo "❌ Timeout esperando base de datos"
        break
    fi
done

# Generar APP_KEY si no existe
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate --force
    echo "APP_KEY generado: $APP_KEY"
fi

# Ejecutar migraciones
echo "📊 Ejecutando migraciones..."
php artisan migrate --force

# Crear usuario admin de Filament
echo "👤 Creando usuario admin de Filament..."
php artisan make:filament-user \
    --name="Admin" \
    --email="admin@admin.com" \
    --password="admin123" || echo "Usuario admin ya existe"

# Limpiar caché
echo "🧹 Limpiando caché..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Intentar compilar assets en runtime si no se compilaron durante build
if [ ! -d "public/build" ]; then
    echo "🎨 Compilando assets en runtime..."
    npm run build || echo "Warning: No se pudieron compilar assets"
fi

# Optimizar para producción
echo "⚡ Optimizando para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlace simbólico para storage
echo "🔗 Creando enlace simbólico..."
php artisan storage:link

# Configurar permisos finales
echo "🔐 Configurando permisos..."
chown -R www-data:www-data storage/ bootstrap/cache/
chmod -R 755 storage/ bootstrap/cache/

echo "✅ Aplicación lista en Render!"
echo "📝 Credenciales admin:"
echo "   Email: admin@admin.com"
echo "   Password: admin123"
echo "   URL Admin: /admin"

# Iniciar Apache
echo "🌐 Iniciando servidor Apache..."
exec apache2-foreground