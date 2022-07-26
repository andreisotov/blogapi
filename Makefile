init:
	docker-compose build --force-rm --no-cache
	make up

up:
	docker-compose -p api-ansotov up -d
	echo "App is running at http://127.0.0.1:8033"

container-app:
	docker exec -it ansotov-api bash

container-mysql:
	docker exec -it mysql-ansotov-api sh

schema-update:
	docker exec -it ansotov-api /home/ansotov-api/bin/console doctrine:database:create --if-not-exists
	docker exec -it ansotov-api /home/ansotov-api/bin/console doctrine:schema:update --force

test-coverage:
	docker exec -it ansotov-api /home/ansotov-api/vendor/bin/phpunit --coverage-html html tests
