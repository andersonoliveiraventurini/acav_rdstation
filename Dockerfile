FROM php:8.4-apache

# Instala dependências do sistema e locale
RUN apt-get update && apt-get install -y \
    locales \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev supervisor \
    && echo "pt_BR.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen pt_BR.UTF-8 \
    && update-locale LANG=pt_BR.UTF-8 \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

ENV LANG=pt_BR.UTF-8
ENV LC_ALL=pt_BR.UTF-8

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

# Configura charset padrão do Apache
RUN echo "AddDefaultCharset UTF-8" > /etc/apache2/conf-available/charset.conf && a2enconf charset

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --prefer-dist --no-interaction

RUN chmod -R 775 storage bootstrap/cache

# ajusta horário Brasil
RUN ln -snf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && echo "America/Sao_Paulo" > /etc/timezone

RUN echo "date.timezone=America/Sao_Paulo" > /usr/local/etc/php/conf.d/timezone.ini

RUN echo "default_charset=UTF-8" > /usr/local/etc/php/conf.d/default_charset.ini

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
