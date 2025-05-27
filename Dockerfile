FROM php:8.2-apache

# Instalar extensões necessárias
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    zip unzip curl \
    && docker-php-ext-install pdo pdo_sqlite

# Ativar mod_rewrite
RUN a2enmod rewrite

# Ajustar o Apache para servir o Laravel corretamente
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copiar app
COPY . /var/www/html

WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Permissões
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expor porta padrão
EXPOSE 80
