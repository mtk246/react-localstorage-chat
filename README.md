<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Develop instalation
## Requirements
* [Docker](https://docs.docker.com/engine/install) v20.10.18+
* [Docker-compose](https://docs.docker.com/compose/install) v2.10.2+ compatible with installed docker version
* [Make](https://linuxhint.com/install-make-ubuntu) linux distribution compatible with make.  **OPTIONAL:** only if you want to install sail in an easy way

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
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
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

# Testing commands

## Syntax check

Run the following command in the console to perform a complete syntax test of the code
´´´bash
make syntax_test_php
´´´
this command should run all the tests in sequence and display the result

it is also possible to run idividual test by its corresponding command

| Command       | description                       |
| ------------- |:---------------------------------:|
| make pint_test| run laravel pint in test mode     |
| make phpcs    | run phpcs syntax check            |
| left phpstan  | run phpstan syntax check - pending|

## Syntax fix

some of the most common syntax errors can be self-fixed by running the command
´´´bash
make syntax_fix_php
´´´
However, some errors must be solved by hand since they do not have a simple solution.
=======
## install

Require node 18.18.2
```
npm i or yarn install
```
```
npm run start or yarn start
```
>>>>>>> 03e1958d ([tsx, json] add actions, reducers, store)
