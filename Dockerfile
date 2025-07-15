FROM php:8.3-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configurar DocumentRoot para Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar Apache para Laravel con mejor configuración
RUN echo '<Directory /var/www/html/public>' >> /etc/apache2/apache2.conf
RUN echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf
RUN echo '    AllowOverride All' >> /etc/apache2/apache2.conf
RUN echo '    Require all granted' >> /etc/apache2/apache2.conf
RUN echo '    DirectoryIndex index.php' >> /etc/apache2/apache2.conf
RUN echo '</Directory>' >> /etc/apache2/apache2.conf

# Configurar headers de Apache para assets
RUN echo 'LoadModule headers_module modules/mod_headers.so' >> /etc/apache2/apache2.conf
RUN a2enmod headers

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Instalar dependencias de Node.js y compilar assets
RUN npm install --force || true
RUN npm run build || echo "Assets will be built at runtime"

# Crear directorios necesarios
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views
RUN mkdir -p bootstrap/cache
RUN mkdir -p public/build public/css public/js

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Exponer puerto 80
EXPOSE 80

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Comando para iniciar
CMD ["/start.sh"]