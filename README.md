# Installation

git clone https://github.com/soyombo0/arba

cd arba

cp .env.example .env

cd docker

docker compose up -d --build

docker compose exec app bash

composer install

php artisan key:generate

php artisan migrate
