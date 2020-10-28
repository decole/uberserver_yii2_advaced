#Uberserver.ru on Yii2
---------------------
как поставить:
 - `docker-compose up -d`
 
 Запуск первый раз:
 - `docker-compose run php bash`
 - `composer install`
 - `php init --env=Development --overwrite=All` -> Development / Production
 - `yii migrate` yes

запуск: 
`make up`


миграции запутить:
`make migrate`


стоп окружение:
`make stop`


потушить окружение
`make down`


рестартануть окружение
`make restart`


composer install
`make composer-install`


залезть во внутрь контейнера с приложением
`make app`


запуск миграции
`make migrate`


отмена 1й миграции
`make migrate-down`


залезть в контейнер с БД
`make mysql`


инициирование проекта
`make app-init`


запуск тестов
`make tests`


запуск тасок
`make tasks`

