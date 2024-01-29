@extends('layout')
@section('title') Стоимость за месяц @endsection
@section('main')
    <h1 class="h1 mt-3">Стоимость за месяц</h1>
    <div id="numbers_check_app">
        <form action="/month_costs/check" method="POST">
            @csrf
            <div class="mb-3">
                <label for="month" class="form-label">Месяц</label>
                <input class="form-control" name="month" id="month" type="date">
            </div>
            <div class="mb-3">
                <label class="form-label" for="cost">Стоимость</label>
                <input class="form-control" v-model="number" name="costs" id="costs" type="text" @input="check_number">
            </div>
            <button class="btn btn-primary" type="submit">Отправить</button>
        </form>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mt-3" role="alert">
            <ul class="mt-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    @if($message)
        <div>
            <ul>
                <li>Стоимость на {{ $message }} месяц обновлена</li>
            </ul>
        </div>
    @endif

    <h2 class="mt-3">Список всех тарифов</h2>
    <div class="row">
    <table class="table table-light table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">Период</th>
            <th scope="col">Тариф</th>
        </tr>
    </thead>
    <tbody>
    @foreach($monthcosts as $el)
    <tr>
        <th>{{ substr($el->month, 0, 7) }}</th>
        <td>{{ $el->costs }} рублей</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
@endsection