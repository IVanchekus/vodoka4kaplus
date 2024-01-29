Для корректной работы необходимо следующее:

- nginx_1.23;
- PHP_7.2;
- PostgreSQL-10;

Рекомендуется использовать OpenServer.
Будьте внимательны! Чтобы БД конкретно отрабатывала, необходимо изменить конфигурацию в .env:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=vodokachka //Название базы данных
DB_USERNAME=postgres //Логин
DB_PASSWORD=postgres //Пароль

Для того, чтобы перейти на страничку сайта, перейдите по запросу: http://vodo 