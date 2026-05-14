FROM php:8.3-fpm

# تثبيت الاعتمادات الأساسية للنظام
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# تنظيف الكاش
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت إضافات PHP اللازمة لـ Laravel و MikroTik API
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مسار العمل
WORKDIR /var/www
