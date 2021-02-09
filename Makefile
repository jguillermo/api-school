.PONY: build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild start-local

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

run:
	symfony serve --port=8080 --no-tls
stop:
	symfony server:stop

clean:
	rm -rf var/cache && rm -rf vendor && make composer-install

test:
	docker exec school-php ./vendor/bin/behat

migration:
	bin/console make:migration

migrate:
	bin/console doctrine:migrations:migrate

up:
	docker-compose up -d

down:
	docker-compose down

composer-install:
	docker run --rm --interactive \
	  --user $$(id -u):$$(id -g) \
      --volume $(PWD):/app \
      composer install