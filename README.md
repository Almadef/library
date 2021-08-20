# Библиотека на Yii2

## Стэк проекта

* nginx 1.17
* php-fpm 7.4
* mysql 5.7
* sphinx 3.1
* memcached 1.6

## План разворачивания dev-окружения через docker-compose

1. В docker/config/nginx создать default.conf;
2. В docker/config/sphinx создать sphinx.conf;
3. Запустить контейнеры для работы с приложением `docker-compose up -d nginx php-fpm mysql sphinx memcached phpmyadmin`;
4. Выполнить комманды для инициализации кодовой базы:
    1. `docker-compose exec php-fpm composer install`;
    2. `docker-compose exec php-fpm php init`;
    3. `docker-compose exec php-fpm php yii migrate-rbac`;
    4. `docker-compose exec php-fpm php yii migrate`;

## Sphinx

После заполнения контента его можно проиндексировать `docker-compose run --rm sphinx indexer --config "/opt/sphinx/conf/sphinx.conf" --all --rotate`:

## Тестирование

Для тестирования используется БД mysql-test, перед началом тестов нужно выполнить комманды:

1. Запустить тестовую базу `docker-compose up -d mysql-test sphinx-test`;
2. Выполнить комманды:
    1. `docker-compose exec php-fpm php yii_test migrate-rbac`;
    2. `docker-compose exec php-fpm php yii_test migrate`, после появления новых миграций ее нужно снова выполнять, для поддержки в актуальном состоянии и этой базы.

Запустить все тесты `docker-compose exec php-fpm composer run-script test`.

Запустить тесты определенного блока программы `docker-compose exec php-fpm vendor/bin/codecept run -c [frontend, backend, common]`.

## Прочие команды

* `docker-compose exec php-fpm php yii user/create-admin <login> <email> <password>` - создать администратора;
* `docker-compose exec php-fpm php yii user/create-librarian <login> <email> <password>` - создать библиотекаря;
* `docker-compose exec php-fpm php yii seed/library` - загрузить сиды авторов, издателей, категорий и книг;
* `docker-compose exec php-fpm composer run-script codesniffer-analysis` - проверить форматирование кода;
* `docker-compose exec php-fpm composer run-script codesniffer-fix` - исправить форматирование кода.
