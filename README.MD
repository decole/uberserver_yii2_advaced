Uberserver.ru on Yii2
---------------------
как поставить:
 - `docker-compose up -d`
 
 Запуск первый раз:
 - `make pull`
 - `make composer-install`
 - `make app-init`
 - настроить параметры для вашего окружения в конфигах (common, frontend, backend)
 - `make migrate` yes

Все нужные команды находятся в Makefile

 - запуск: `make up`
 - миграции запутить: `make migrate`
 - стоп окружение: `make stop`
 - потушить окружение: `make down`
 - рестартануть окружение: `make restart`
 - composer install: `make composer-install`
 - залезть во внутрь контейнера с приложением: `make app`
 - запуск миграции: `make migrate`
 - отмена 1й миграции: `make migrate-down`
 - залезть в контейнер с БД: `make mysql`
 - инициирование проекта: `make app-init`
 - запуск тестов: `make tests`
 - запуск тасок (сейчас это устаревшее решение - используется для разработки): `make tasks`
 - запуск mqtt парсера датчиков (сейчас это устаревшее решение - используется для разработки): `make mqtt`
 