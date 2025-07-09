include .env

init: docker-down-clear \
	composer-install \
	npm-i npx-mix \
	migrate

up:
	docker compose up -d
rebuild:
	docker compose down -t 0 && docker compose up --build
down:
	docker compose down -t 0 --remove-orphans
build:
	docker compose up --build -d

docker-down-clear:
	docker compose down -v --remove-orphans

composer-install:
	docker compose exec php-fpm composer install

migrate:
	docker compose exec php-fpm php artisan migrate

bash:
	docker compose exec php-fpm /bin/bash
sh:
	docker compose exec php-fpm /bin/sh

node-bash:
	docker compose run --rm node /bin/sh
npm-i:
	docker compose run --rm node npm i
npx-mix:
	docker compose run --rm node npx mix
npm-run-prod:
	docker compose run --rm node npm run prod

# HOST=185.255.132.6 PORT=2222 BUILD_NUMBER=1 KEY=provisioning/files/deploy_rsa make deploy
deploy:
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'rm -rf site_${BUILD_NUMBER}'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'mkdir site_${BUILD_NUMBER}'
	scp -P ${PORT} -i ${KEY} docker-compose.yml deploy@${HOST}:site_${BUILD_NUMBER}/docker-compose.yml
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'cd site_${BUILD_NUMBER} && echo "COMPOSE_PROJECT_NAME=phpqa" >> .env'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'cd site_${BUILD_NUMBER} && docker compose up --build --remove-orphans -d'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'rm -f site'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'ln -sr site_${BUILD_NUMBER} site'

rollback:
	ssh deploy@${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker compose pull'
	ssh deploy@${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker compose up --build --remove-orphans -d'
	ssh deploy@${HOST} -p ${PORT} 'rm -f site'
	ssh deploy@${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'

a:
	sudo chmod 777 -R ${APP_STORAGE_LOCATION}

routes:
	docker compose exec php-fpm php artisan route:list

# Testing commands
test:
	docker compose exec php-fpm ./vendor/bin/phpunit

test-filter:
	docker compose exec php-fpm ./vendor/bin/phpunit --filter $(FILTER)

test-coverage:
	docker compose exec php-fpm ./vendor/bin/phpunit --coverage-html coverage

# Code quality commands
rector:
	docker compose exec php-fpm ./vendor/bin/rector process --dry-run

rector-fix:
	docker compose exec php-fpm ./vendor/bin/rector process

phpstan:
	@if [ "$$(git rev-parse --abbrev-ref HEAD)" = "master" ]; then \
		git diff --name-only --diff-filter=ACM HEAD~1 | grep "\.php$$" | xargs -r docker compose exec -T php-fpm vendor/bin/phpstan analyse --memory-limit=2048M; \
	else \
		git diff --name-only --diff-filter=ACM origin/master | grep "\.php$$" | xargs -r docker compose exec -T php-fpm vendor/bin/phpstan analyse --memory-limit=2048M; \
	fi

cs-fix:
	docker compose exec php-fpm ./vendor/bin/php-cs-fixer fix
