include .env

init: docker-down-clear \
	docker-up \
	composer-install \
	npm-i npx-mix \
	migrate

up: docker-up
down: docker-down

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans


composer-install:
	docker-compose run --rm php-fpm composer install

migrate:
	docker-compose run --rm php-fpm php artisan migrate

bash:
	docker-compose run --rm php-fpm /bin/sh

node-bash:
	docker-compose run --rm node /bin/sh
npm-i:
	docker-compose run --rm node npm i
npx-mix:
	docker-compose run --rm node npx mix
npm-run-prod:
	docker-compose run --rm node npm run prod

# HOST=185.174.137.12 PORT=2222 BUILD_NUMBER=1 KEY=provisioning/files/deploy_rsa make deploy
deploy:
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'rm -rf site_${BUILD_NUMBER}'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'mkdir site_${BUILD_NUMBER}'
	scp -P ${PORT} -i ${KEY} docker-compose-production.yml deploy@${HOST}:site_${BUILD_NUMBER}/docker-compose.yml
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'cd site_${BUILD_NUMBER} && echo "COMPOSE_PROJECT_NAME=phpqa" >> .env'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'cd site_${BUILD_NUMBER} && docker-compose up --build --remove-orphans -d'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'rm -f site'
	ssh deploy@${HOST} -p ${PORT} -i ${KEY} 'ln -sr site_${BUILD_NUMBER} site'

rollback:
	ssh deploy@${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose pull'
	ssh deploy@${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose up --build --remove-orphans -d'
	ssh deploy@${HOST} -p ${PORT} 'rm -f site'
	ssh deploy@${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'
