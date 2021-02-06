.PONY: build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild start-local

run:
	symfony serve --port=8080 --no-tls
stop:
	symfony server:stop --dir=apps/mooc/backend/public

