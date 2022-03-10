<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Description 

Car End point to list cars with pagination, filtration and sorting
    build using repository design pattern. 

Tables :
    cars
    carmodels
    brand
    category
    engine

## End points

    index api/v1/cars?
    show  api/v1/cars/{id}

## To run
    composer install
    php artisan migrate
    php artisan SystemData:seed
    php artisan db:seed
    php artisan serve --port=8000

## To run test 
    php artisan test

## documentation 

https://documenter.getpostman.com/view/3093123/UVsG19V9

### ERD 

https://drive.google.com/file/d/1tGxExs8py8wshtaHWjrPDugvTj-CgIod/view


