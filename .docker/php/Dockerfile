FROM ubuntu

LABEL maintainer "Thomas CILES<thomasciles@gmail.com>"

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV TZ=Europe/Paris

RUN addgroup --system appgroup 
RUN useradd -r -m -s /usr/sbin/nologin -g appgroup -u 1000 appuser
RUN groupmod -g 1000 www-data

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update -y \
    && apt-get upgrade -y \
    && apt-get install -y software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update -y \
    && apt-get install -y \
    wget \
    make \
    curl \
    bash \
    git

RUN apt-get install -y php8.0-fpm php8.0-mysql php8.0-mbstring php8.0-intl php8.0-xml

RUN echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
        && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
        && php composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash \ 
        && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email "thomasciles@gmail.com" \
        && git config --global user.name "Thomas CILES"

COPY ./conf/php.ini /etc/php/8.0/fpm/php.ini
COPY ./conf/php-fpm.conf /etc/php/8.0/fpm/php-fpm.conf
COPY ./conf/pool.d /etc/php/8.0/fpm/pool.d

RUN mkdir /run/php


COPY startup.sh /usr/local/bin/start-up
RUN chmod 0777 /usr/local/bin/start-up -R
RUN chmod u+s /usr/sbin/php-fpm8.0


RUN symfony check:requirements


USER appuser

ENTRYPOINT /usr/local/bin/start-up

WORKDIR /var/www/html

EXPOSE 9000
