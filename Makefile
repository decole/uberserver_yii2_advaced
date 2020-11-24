message = @echo "\n----------------------------------------\n$(1)\n----------------------------------------\n"

ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))

root = $(dir $(realpath $(lastword $(MAKEFILE_LIST))))
compose = docker-compose

app = $(compose) exec -T php
yii = $(app) php yii

pull:
	$(compose) pull

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
	$(compose) exec php bash

migrate:
	$(yii) migrate --interactive=0

migrate-create:
ifeq ("$(ARGS)", "")
	@echo "Missing argument with name migration\n"
	@echo "Example: make migrate-create create_some_table"
else
	$(call message,"Executing create migration on database")
	$(yii) migrate/create $(ARGS)
	$(call message,"Done!")
endif

migrate-down:
	$(yii) migrate/down

mysql:
	$(compose) exec mysql bash

app-init:
	$(app) php init --env=Development --overwrite=All

app-init-prod:
	$(app) php init --env=Production --overwrite=All

tests:
	$(app) vendor/bin/codecept run

tasks:
	$(yii) queue/listen 5 -v --color

mqtt:
	$(yii) mqtt/start