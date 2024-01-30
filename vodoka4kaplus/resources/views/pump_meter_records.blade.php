@extends('layout')
@section('title') Показания счетчиков @endsection
@section('main')
    <h1 class="mt-3">Показания счетчиков</h1>
    <div id="numbers_check_app">
        <form action="/pump_meter_records/check" method="POST">
        @csrf
        <div class="mb-3">
            <label for="month" class="form-label">Месяц</label>
            <input class="form-control" name="month" id="month" type="date">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Объем (м^3)</label>
            <input class="form-control" type="text" name="amount" id="amount" @input="check_number" v-model="number">
        </div>

        <button class="btn btn-primary" type="submit">Отправить</button>
        </form>
    </div>

    @if($message)
        <ul>
            <li>Счет на {{ $message }} уже существует</li>
        </ul>
    @endif

    <h2 class="mt-3">Показания счетчиков</h2>
    <div class="alert alert-warning">Каждый месяц показания счетчиков должны увеличиваться</div>
    <table class="table table-light table-striped mt-3">
    <thead>
        <tr> 
            <th scope="col">Период</th>
            <th scope="col">Объем</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pump_meter_records as $el)
            <tr>
                <th>{{ substr($el->begin_date, 0, 7) }}</th>
                <td>{{ $el->amount_volume }} м<sup>3</sup></td>
            </tr>
        @endforeach
    </tbody>
    </table>
@endsection