message = @echo "\n----------------------------------------\n$(1)\n----------------------------------------\n"
root = $(dir $(realpath $(lastword $(MAKEFILE_LIST))))
compose = docker-compose

app = $(compose) exec -T backend
yii = $(app) php yii

up:
	$(compose) up -d --remove-orphans

stop:
	$(compose) stop

down:
	$(compose) down

restart: down up
	$(call message,"Restart completed")

update: down
	$(compose) pull
	$(MAKE) up
	$(call message,"Update completed")

composer-install:
	$(app) composer install

app:
	$(compose) exec backend bash

migrate:
	$(yii) migrate

migrate-down:
	$(yii) migrate/down

mysql:
	$(compose) exec mysql bash

app-init:
	$(app) php init --env=Development --overwrite=All

tests:
	$(app) vendor/bin/codecept run

tasks:
	$(yii) queue/listen 5 -v --color

tasks-stop:
	$(app) ./tasks-stop.sh