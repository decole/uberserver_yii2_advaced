#Uberserver.ru on Yii2
---------------------
Как поставить:
 - `sudo docker-compose up -d --build`
 
 
Запуск первый раз:
 - `make app-init`
 - `make composer-install`
 - `make migrate`
 

Запуск: 
`make up`


Миграции запутить:
`make migrate`


Создать миграцию:
`make migrate-create <text-migrate-name>`


Потушить окружение:
`make stop`


Рестартануть окружение
`make restart`


composer install
`make composer-install`


Залезть во внутрь контейнера с приложением
`make app`


Запуск миграции
`make migrate`


Отмена 1й миграции
`make migrate-down`


Залезть в контейнер с БД
`make mysql`


Инициирование проекта
`make app-init`
`make app-init-prod`


Запуск тестов
`make tests`


Запуск тасок
`make tasks`


Запуск парсера mqtt
`make mqtt`