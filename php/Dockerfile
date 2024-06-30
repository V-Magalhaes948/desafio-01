# Utiliza a imagem PHP 8.0 FPM como base
FROM php:8.0-fpm

# Atualiza o gerenciador de pacotes do sistema
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip

# Instala as dependências do Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Define o diretório de trabalho dentro do container
WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql

# Copia os arquivos do projeto Laravel para dentro do container
COPY ./laravel /var/www/html

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Define permissões apropriadas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN chown -R www-data:www-data storage/logs \
    && chmod -R 775 storage    

# Expondo a porta 9000 para conexões do PHP-FPM
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]