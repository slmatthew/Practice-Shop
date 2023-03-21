## Это проект, который мне задали на учебной практике

Он стал моим первым опытом использования <a href="https://laravel.com" target="_blank">Laravel</a>, поэтому код ожидаемо не очень.

## Установка

1. Склонировать репозиторий
2. Перейти в папку проекта
2. `composer install`
3. `php artisan migrate`
4. Не забыть настроить [nginx](#конфиг-nginx)

> **Я использовал связку nginx 1.21.4 + PHP 8.2 + Laravel 9 + MySQL 5.7.40**

### Немного про миграции

В миграциях уже добавлены категории и товары, поэтому сайт изначально будет заполнен всякими гадежтами и прочим.

Пользователь с `id = 1` защищен от удаления и сброса пароля, поэтому я решил добавить его в миграции. Данные:

* логин: admin
* пароль: 12345678

### Конфиг nginx

Конфиг всегда создается aaPanel, я только включил в него директивы, необходимые для работы Laravel

```nginx
server
{
    listen 80;
    listen 443 ssl http2;
    server_name example.com;
    index index.php;
    root /www/up11-shop/public;
    
    if ($server_port !~ 443){
        rewrite ^(/.*)$ https://$host$1 permanent;
    }
    
    # тут ssl-сертификат
    
    add_header Strict-Transport-Security "max-age=31536000";
    error_page 497  https://$host$request_uri;

    # общий конфиг для php
    include enable-php-82.conf;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    location ~ ^/(\.user.ini|\.htaccess|\.git|\.svn|\.project|LICENSE|README.md)
    {
        return 404;
    }

    location ~ \.well-known{
        allow all;
    }

    location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
    {
        expires      30d;
        error_log /dev/null;
        access_log off;
    }

    location ~ .*\.(js|css)?$
    {
        expires      12h;
        error_log /dev/null;
        access_log off; 
    }
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
 
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    access_log  /www/logs/example.com.log;
    error_log  /www/logs/example.com.error.log;
}
```

## .env

Не забудьте поменять значение `APP_URL`! Оно используется для сохранения в БД полного адреса загружаемых изображений, по умолчанию - `https://shop.slmatthew.ru`
