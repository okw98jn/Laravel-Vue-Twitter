# コンテナ起動
up:
	docker compose up -d

# コンテナ停止
down:
	docker compose down

# コンテナイメージボリューム削除
destroy:
	docker compose down --rmi all --volumes --remove-orphans

# コンテナビルド
build:
	docker compose build --no-cache --force-rm

# コンテナシェルログイン(laravel)
sh:
	docker compose exec app bash

# コンテナシェルログイン(mysql)
sh-mysql:
	docker compose exec mysql bash

# git clone
laravel-install:
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache

# laravel create-project
laravel-create:
	docker compose exec app composer create-project laravel/laravel .
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache

# composer install
composer-install:
	docker compose exec app composer install

# laravelキャッシュクリア
clear:
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear

# migrate
migrate:
	docker compose exec app php artisan migrate --seed

# db:seed
seed:
	docker compose exec app php artisan db:seed

# migrate:fresh
fresh:
	docker compose exec app php artisan migrate:fresh --seed

# Pint
Pint:
	docker compose exec app ./vendor/bin/pint

# stan
stan:
	docker compose exec app ./vendor/bin/phpstan analyse --memory-limit=2G

# npm install
npm-i:
	docker compose exec app npm install

# npm run dev
npm-d:
	docker compose exec app npm run dev