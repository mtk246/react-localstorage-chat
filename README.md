<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Develop instalation
## Requirements
* [Docker](https://docs.docker.com/engine/install) ^V 20.10.18, build b40c2f6+
* [Docker-compose](https://docs.docker.com/compose/install) ^V v2.10.2+ compatible with installed docker version
* [Make](https://linuxhint.com/install-make-ubuntu) linux distribution compatible with make *OPTIONAL: only if you want to install sail in an easy way

## sail + make instalation

after cloning the repository, open a console in the root directory of the project and run
```bash
make aio
```
this command should build the containers, install the dependencies and migrate the database.

next configure a shell alias for sail runing this command
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
finally use [sail](https://laravel.com/docs/8.x/sail) commands to operate the project

## pure sail instalation

After cloning the repository, create the wrapper for Laravel sail by opening a console in the root directory of the project and run
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs \
    && cp ./.env.example .env
```
next configure a shell alias for sail runing this command
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
next build the project runing
```bash
sail build
```
next pull up the containers and install the dependencies
```bash
sail up -d
sail composer install
sail artisan key:generate
```
next migrate and seed database
```bash
sail artisan migrate:fresh
sail artisan db:seed
```
finally use [sail](https://laravel.com/docs/8.x/sail) commands to operate the project
