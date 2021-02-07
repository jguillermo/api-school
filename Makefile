.PONY: build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild start-local

run:
	symfony serve --port=8080 --no-tls
stop:
	symfony server:stop

clean:
	rm -rf var/cache && rm -rf vendor && composer install

test:
	vendor/bin/behat

migration:
	bin/console make:migration

migrate:
	bin/console doctrine:migrations:migrate
