#Uberserver.ru on Yii2
---------------------
как поставить:
 - `docker-compose up -d`
 
 Запуск первый раз:
 - `docker-compose run backend bash`
 - `composer install`
 - `php init` -> 0 = Development / 1 = Production
 - `yii migrate` yes

запуск: 
`make up`


миграции запутить:
`make migrate`


стоп окружение:
`stop`


потушить окружение
`down`


рестартануть окружение
`restart`


composer install
`composer-install`


залезть во внутрь контейнера с приложением
`app`


запуск миграции
`migrate`


отмена 1й миграции
`migrate-down`


залезть в контейнер с БД
`mysql`


инициирование проекта
`app-init`


запуск тестов
`tests`


pfgecr таск
`tasks`


таски остановить
`tasks-stop`