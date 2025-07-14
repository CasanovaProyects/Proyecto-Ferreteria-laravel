#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel + Filament en Render..."

# Crear archivo .env completo si no existe
if [ ! -f .env ]; then
    echo "📝 Creando archivo .env completo..."
    cat > .env << 'EOF'
APP_NAME=Ferreteria
APP_ENV=production
APP_KEY=base64:r1GcTGWd4vJ7u3AfbfGXHL9phKDa2FMOdpmHbRWSuhw=
APP_DEBUG=false
APP_URL=https://proyecto-ferreteria-laravelcasanovajuan.onrender.com
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
APP_MAINTENANCE_DRIVER=file
PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12
LOG_CHANNEL=single
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error
DB_CONNECTION=mysql
DB_HOST=sql201.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_39096135_ferreteria
DB_USERNAME=if0_39096135
DB_PASSWORD=kzl7k67Ncs
DB_FOREIGN_KEYS=true
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
CACHE_STORE=file
MEMCACHED_HOST=127.0.0.1
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS=hello@ferreteria.com
MAIL_FROM_NAME=Ferreteria
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
VITE_APP_NAME=Ferreteria
EOF
fi

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