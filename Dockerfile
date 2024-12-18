# Create args for PHP extensions and PECL packages we need to install.
# This makes it easier if we want to install packages,
# as we have to install them in multiple places.
# This helps keep ou Dockerfiles DRY -> https://bit.ly/dry-code
# You can see a list of required extensions for Laravel here: https://laravel.com/docs/8.x/deployment#server-requirements
ARG PHP_EXTS="bcmath ctype fileinfo mbstring pdo pdo_pgsql pgsql dom pcntl exif gd"
ARG PHP_PECL_EXTS="redis"
ARG APP_NAME="tiptop"

# We need to build the Composer base to reuse packages we've installed
FROM composer:lts as composer_base

ARG PHP_EXTS
ARG PHP_PECL_EXTS
ARG APP_NAME

# First, create the application directory, and some auxilary directories for scripts and such
RUN mkdir -p /opt/apps/${APP_NAME} /opt/apps/${APP_NAME}/bin

# Next, set our working directory
WORKDIR /opt/apps/${APP_NAME}

# We need to create a composer group and user, and create a home directory for it, so we keep the rest of our image safe,
# And not accidentally run malicious scripts

# We need to create a composer group and user, and create a home directory for it, so we keep the rest of our image safe,
# And not accidentally run malicious scripts
RUN addgroup -S composer \
    && adduser -S composer -G composer \
    && chown -R composer /opt/apps/${APP_NAME}

# Install system dependencies first
RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} \
    openssl \ 
    ca-certificates \ 
    libxml2-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libpq-dev \
    postgresql-dev

# Install PHP extensions
RUN docker-php-ext-install ${PHP_EXTS}
RUN pecl install ${PHP_PECL_EXTS}
RUN docker-php-ext-enable ${PHP_PECL_EXTS}
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Next we want to switch over to the composer user before running installs.
# This is very important, so any extra scripts that composer wants to run,
# don't have access to the root filesystem.
# This especially important when installing packages from unverified sources.
USER composer

# Copy in our dependency files.
# We want to leave the rest of the code base out for now,
# so Docker can build a cache of this layer,
# and only rebuild when the dependencies of our application changes.
COPY --chown=composer composer.json composer.lock ./

# Install all the dependencies without running any installation scripts.
# We skip scripts as the code base hasn't been copied in yet and script will likely fail,
# as `php artisan` available yet.
# This also helps us to cache previous runs and layers.
# As long as comoser.json and composer.lock doesn't change the install will be cached.
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy in our actual source code so we can run the installation scripts we need
# At this point all the PHP packages have been installed, 
# and all that is left to do, is to run any installation scripts which depends on the code base
COPY --chown=composer . .

# Now that the code base and packages are all available,
# we can run the install again, and let it run any install scripts.
RUN composer install --optimize-autoloader --no-dev --prefer-dist

USER root

# Remove build dependencies to reduce image size
RUN apk del build-dependencies

USER composer

















# For the frontend, we want to get all the Laravel files,
# and run a production compile
FROM node:18 as frontend

ARG APP_NAME

# We need to copy in the Laravel files to make everything is available to our frontend compilation
COPY --from=composer_base /opt/apps/${APP_NAME} /opt/apps/${APP_NAME}

WORKDIR /opt/apps/${APP_NAME}

# We want to install all the NPM packages,
RUN npm install && \
    npm run build












# For running things like migrations, and queue jobs,
# we need a CLI container.
# It contains all the Composer packages,
# and just the basic CLI "stuff" in order for us to run commands,
# be that queues, migrations, tinker etc.
FROM php:8.1-alpine as cli

# We need to declare that we want to use the args in this build step
ARG PHP_EXTS
ARG PHP_PECL_EXTS
ARG APP_NAME

WORKDIR /opt/apps/${APP_NAME}

# We need to install some requirements into our image,
# used to compile our PHP extensions, as well as install all the extensions themselves.
# You can see a list of required extensions for Laravel here: https://laravel.com/docs/8.x/deployment#server-requirements
RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} \
    openssl \ 
    ca-certificates \ 
    libxml2-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libpq-dev \
    postgresql-dev \ 
    postgresql-libs

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) ${PHP_EXTS}
RUN pecl install ${PHP_PECL_EXTS}
RUN docker-php-ext-enable ${PHP_PECL_EXTS}
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Next we have to copy in our code base from our initial build which we installed in the previous stage
COPY --from=composer_base /opt/apps/${APP_NAME} /opt/apps/${APP_NAME}
COPY --from=frontend /opt/apps/${APP_NAME}/public /opt/apps/${APP_NAME}/public






















# We need a stage which contains 4 to actually run and process requests to our PHP application.
FROM php:8.1-fpm-alpine as fpm_server

# We need to declare that we want to use the args in this build step
ARG PHP_EXTS
ARG PHP_PECL_EXTS
ARG APP_NAME

WORKDIR /opt/apps/${APP_NAME}

RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} \
    openssl \ 
    ca-certificates \ 
    libxml2-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    postgresql-dev

# Install PHP extensions
RUN docker-php-ext-install ${PHP_EXTS}
RUN pecl install ${PHP_PECL_EXTS}
RUN docker-php-ext-enable ${PHP_PECL_EXTS}
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# As FPM uses the www-data user when running our application,
# we need to make sure that we also use that user when starting up,
# so our user "owns" the application when running
USER  www-data

# We have to copy in our code base from our initial build which we installed in the previous stage
COPY --from=composer_base --chown=www-data:www-data /opt/apps/${APP_NAME} /opt/apps/${APP_NAME}
COPY --from=frontend --chown=www-data:www-data /opt/apps/${APP_NAME}/public /opt/apps/${APP_NAME}/public

RUN chmod -R 755 /opt/apps/${APP_NAME}/bootstrap/cache
RUN chmod -R 755 /opt/apps/${APP_NAME}/storage

# We want to cache the event, routes, and views so we don't try to write them when we are in Kubernetes.
# Docker builds should be as immutable as possible, and this removes a lot of the writing of the live application.
RUN php artisan event:cache && \
    php artisan route:cache












# We need an nginx container which can pass requests to our FPM container,
# as well as serve any static content.
FROM nginx:1.20-alpine as web_server

ARG APP_NAME

WORKDIR /opt/apps/${APP_NAME}

# We need to add our NGINX template to the container for startup,
# and configuration.
COPY infra/nginx/nginx.conf /etc/nginx/templates/default.conf.template

# Copy in ONLY the public directory of our project.
# This is where all the static assets will live, which nginx will serve for us.
COPY --from=frontend /opt/apps/${APP_NAME}/public /opt/apps/${APP_NAME}/public









# We need a CRON container to the Laravel Scheduler.
# We'll start with the CLI container as our base,
# as we only need to override the CMD which the container starts with to point at cron
FROM cli as cron

WORKDIR /opt/apps/${APP_NAME}

# We want to create a laravel.cron file with Laravel cron settings, which we can import into crontab,
# and run crond as the primary command in the forground

USER root

RUN touch laravel.cron && \
    echo "* * * * * cd /opt/apps/${APP_NAME} && php artisan schedule:run" >> laravel.cron && \
    crontab laravel.cron

CMD ["crond", "-l", "2", "-f"]

FROM cli












FROM cli