<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Главная</a>
            <a class="navbar-brand" href="/month_costs">Тариф</a>
            <a class="navbar-brand" href="/pump_meter_records">Показания счетчиков</a>
            <a class="navbar-brand" href="/residents">Дачники</a>
        </div>
    </nav>
    <div class="container">
    @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>