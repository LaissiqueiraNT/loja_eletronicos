FROM thecodingmachine/php:8.2-v4-apache-node18

USER root

# Atualiza pacotes e define locale
RUN apt-get update \
    && apt-get install -y locales \
    && locale-gen pt_BR.UTF-8 \
    && update-locale LANG=pt_BR.UTF-8

USER docker

# Setar variável de ambiente para pt_BR.UTF-8
ENV LANG pt_BR.UTF-8

# Adiciona intl aqui 👇 junto com gd
ENV PHP_EXTENSIONS="gd intl"

# Se quiser copiar o php.ini
# COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini

# Define a pasta pública do Laravel
ENV APACHE_DOCUMENT_ROOT=public/
