FROM php:8.2-fpm

# Instalar extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos da aplicação
COPY . /var/www/html

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]

