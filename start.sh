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
APP_URL=https://sermaxferrecasanova.onrender.com
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
DB_CONNECTION=pgsql
DB_HOST=dpg-d1qntaripnbc73dficpg-a
DB_PORT=5432
DB_DATABASE=dbferreteria
DB_USERNAME=dbferreteria_user
DB_PASSWORD=CWAGWgsX4DEnEgW1oVf6s1sfvAM2JfTy
DATABASE_URL=postgresql://dbferreteria_user:CWAGWgsX4DEnEgW1oVf6s1sfvAM2JfTy@dpg-d1qntaripnbc73dficpg-a/dbferreteria
PGDATABASE=dbferreteria
PGHOST=dpg-d1qntaripnbc73dficpg-a
PGPASSWORD=CWAGWgsX4DEnEgW1oVf6s1sfvAM2JfTy
PGPORT=5432
PGUSER=dbferreteria_user
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

# Configurar permisos iniciales
echo "🔐 Configurando permisos iniciales..."
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

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

# Limpiar todo el caché antes de proceder
echo "🧹 Limpiando caché completo..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# Crear usuario admin de Filament ANTES de cachear rutas
echo "👤 Creando usuario admin de Filament..."
php artisan make:filament-user \
    --name="Admin" \
    --email="admin@admin.com" \
    --password="admin123" || echo "Usuario admin ya existe"

# Publicar assets de Filament ANTES de cachear
echo "🎨 Publicando assets de Filament..."
php artisan filament:install --panels
php artisan vendor:publish --tag=filament-config
php artisan vendor:publish --tag=filament-assets --force
php artisan vendor:publish --tag=filament-views

# Verificar que los directorios importantes existan
echo "📁 Verificando estructura de directorios..."
mkdir -p public/css public/js public/build public/css/filament public/js/filament
chmod -R 755 public/

# Compilar assets si no se compilaron durante build
echo "🎨 Verificando y compilando assets..."
if [ ! -d "public/build" ] || [ ! "$(ls -A public/build)" ]; then
    echo "Compilando assets con Vite..."
    npm install --production=false
    npm run build || echo "Warning: Fallo en npm run build"
fi

# Crear enlace simbólico para storage
echo "🔗 Creando enlace simbólico..."
php artisan storage:link

# Optimizar para producción
echo "⚡ Optimizando para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar que los directorios importantes existan
echo "📁 Verificando estructura de directorios..."
mkdir -p public/css public/js public/build public/css/filament public/js/filament
chmod -R 755 public/

# Configurar permisos finales
echo "🔐 Configurando permisos finales..."
chown -R www-data:www-data storage/ bootstrap/cache/ public/
chmod -R 755 storage/ bootstrap/cache/ public/
chmod -R 755 public/css/ public/js/ public/build/

# Asegurar que Apache pueda leer los assets
echo "🌐 Configurando permisos de Apache..."
chown -R www-data:www-data /var/www/html/public
find public/ -type f -exec chmod 644 {} \;
find public/ -type d -exec chmod 755 {} \;

echo "✅ Aplicación lista en Render!"
echo "📝 Credenciales admin:"
echo "   Email: admin@admin.com"
echo "   Password: admin123"
echo "   URL Admin: /admin"
echo "   URL Login: /admin/login"

# Iniciar Apache
echo "🌐 Iniciando servidor Apache..."
exec apache2-foreground