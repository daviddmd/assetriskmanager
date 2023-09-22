install:
	@make down
	docker volume rm -f assetriskmanager_php-files
	@make build
	@make up
	@make migrate
	@make storage-link
	@make cache
	docker image prune -af
up:
	docker compose up -d
build:
	docker compose build
remake:
	@make destroy
	@make install
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
ps:
	docker compose ps
web:
	docker compose exec web bash
shell:
	docker compose exec app bash
shell_db:
	docker compose exec db bash
shell_web:
	docker compose exec web bash
migrate:
	docker compose exec app php artisan migrate
fresh:
	docker compose exec app php artisan migrate:fresh --seed
seed:
	docker compose exec app php artisan db:seed
cache:
	docker compose exec app composer dump-autoload -o
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan config:cache
	docker compose exec app php artisan route:cache
	docker compose exec app php artisan view:cache
cache-clear:
	docker compose exec app composer clear-cache
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan event:clear
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear
prune:
	docker system prune -a
key-generate:
	docker compose exec app php artisan key:generate
	@make cache
storage-link:
	docker compose exec app php artisan storage:link
update-cache:
	@make cache-clear
	@make cache
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow
log-web:
	docker compose logs web
log-web-watch:
	docker compose logs --follow web
log-app:
	docker compose logs app
log-app-watch:
	docker compose logs --follow app
log-db:
	docker compose logs db
log-db-watch:
	docker compose logs --follow db