<h1 align="center">Welcome to PromoCode Rest API 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1-blue.svg?cacheSeconds=2592000" />
  <a href="https://documenter.getpostman.com/view/1825277/UVsHUoN4" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="https://twitter.com/Kmangwels" target="_blank">
    <img alt="Twitter: Kmangwels" src="https://img.shields.io/twitter/follow/Kmangwels.svg?style=social" />
  </a>
</p>

<p>This api is also hosted on http://3.83.87.196/</p>
<p>API Documentation is located at https://documenter.getpostman.com/view/1825277/UVsHUoN4</p>

## DEPLOYING
### 🏠 [Requirements](Requirements)
<ul>
	<li>php 8.0 and above</li>
	<li>composer version 2 </li>
	<li>Mysql database </li>
</ul>

## Setting up and Running the API

### ✨ [Clone](Clone the repo)

```sh
  git clone https://github.com/Mangweli/PromoCode_RestAPI.git
  cd PromoCode_RestAPI
```

### ✨ [Dependancies](Install Dependancies)

```sh
  git clone https://github.com/Mangweli/PromoCode_RestAPI.git
  cd PromoCode_RestAPI
```

### ✨ [env](Environment Variables)

> Copy `.env.example` to `.env`

```sh
  cp .env.example .env 
```
edit .env file and enter your environment variables

### ✨ [Artisan](Run Artisan Commands)

```sh
  Run php artisan optimize:clear //BUT NOT A MUST
  Run php artisan migrate
  Run php artisan serve
```

## Run tests

```sh
php artisan test or composer test
```

## DEPLOYING WITH DOCKER
### 🏠 [Requirements](Requirements)

> Docker Installed on your machine

## Setting up and Running the API

### ✨ [Clone](Clone the repo)

```sh
  git clone https://github.com/Mangweli/PromoCode_RestAPI.git
  cd PromoCode_RestAPI
```

### ✨ [Dependancies](Install Dependancies)

```sh
  git clone https://github.com/Mangweli/PromoCode_RestAPI.git
  cd PromoCode_RestAPI
```

### ✨ [env](Environment Variables)

> Copy `.env.example` to `.env`

```sh
  cp .env.example .env 
```
<ul>
	<li>Edit .env file and enter your environment variables</li>
	<li>Make sure DB_HOST is changed to  mysql</li>
</ul>

## Folder structure Permissions

```sh
sudo chown -R $USER:www-data .
sudo find . -type f -exec chmod 664 {} \;   
sudo find . -type d -exec chmod 775 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

## Docker Commands

```sh
docker-compose up -d
docker-compose exec -T app composer install
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan migrate
```

## Run Tests
```sh
docker-compose exec -T app php artisan test or docker-compose exec -T app composer test
```

## Running the App

<p>The app will be live on 127.0.0.1:8100</p>
<p>This can be accessed through any  browsers or any api simulation app</p>



## Author

👤 **Kingsley**

* Website: Author Website Here
* Twitter: [@Kmangwels](https://twitter.com/Kmangwels)
* Github: [@Mangweli](https://github.com/Mangweli)
* LinkedIn: [@Kingsley Amaitsa](https://linkedin.com/in/Kingsley Amaitsa)


## Show your support

Give a ⭐️ if this project helped you!

## 📝 License

Copyright © 2022 [Kingsley](https://github.com/Mangweli).<br />

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
