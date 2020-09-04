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

mysql:
	$(compose) exec mysql bash

#app-init:
#	$(app) php init --env=Development --overwrite=All

#migrate: migrate-main migrate-personal migrate-stat
#	$(call message,"Migrations was successfully applied!")

#tests:
#	$(app) vendor/bin/codecept run

#tasks: tasks-stop
#	$(yii) task/run

#tasks-stop:
#	$(app) ./.dev/scripts/tasks-stop.sh

#install: up composer-install app-init create-databases migrate
#	$(call message,"The application was successfully installed!")
