# PROMOCODE REST API

This api is also hosted on 

## REQUIREMENTS
$ php 8.0 and above
$ composer version 2
$ Mysql database


## Setting up and Running the app

Clone the repo:
```
$ git clone https://github.com/Mangweli/PromoCode_RestAPI.git
$ cd PromoCode_RestAPI
```
Install Dependancies:
```
$ run composer install
```
Copy `.env.example` to `.env`
```
$ cp .env.example .env 
$ Edit .env file and enter your environment variables

```
Run Artisan and NPM Commands
```
$ Run php artisan optimize:clear //BUT NOT A MUST
$ Run php artisan migrate
$ Run php artisan serve

```
Setting up scheduler
```

If running locally, on a different terminal Run the command php artisan schedule:work 
If running on a server and a cron configuration on the crontab - 
* * * * * php /var/www/Blogging-platform/artisan schedule:run 1>> /dev/null 2>&1

```
Running unit tests
```
$ run php artisan test OR composer test

## DEPLOYING WITH DOCKER
## REQUIREMENTS
$ Docker Installed on your machine

## Setting up and Running the app

Clone the repo:
```
$ git clone https://github.com/Mangweli/PromoCode_RestAPI.git
$ cd PromoCode_RestAPI

$ cp .env.example .env 
$ Edit .env file and enter your environment variables


