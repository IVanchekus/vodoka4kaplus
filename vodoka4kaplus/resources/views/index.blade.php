@extends('layout')

@section('title') Главная страница @endsection

@section('main')
<h1 class="mt-3">Добро пожаловать на Водокачка+</h1>
<h2>Полный список счетов</h2>

<form action="/countBills" method="POST">
    @csrf
    <div class="mb-3">
    <label class="form-label" for="period_id">Произвести перерасчет необходимого периода</label>
    <!-- <input class="form-control" type="number" id="period_id" name="period_id" placeholder="ID периода"> -->
    <select id="period_id" class="form-control" name="period_id">
        <option value></option>
        @foreach ($months as $month)
            <option value="{{ $month->id }}">{{ substr($month->begin_date, 0, 7) }}</option>
        @endforeach
    </select>
    </div>
    <button class="btn btn-primary" type="submit">Перерасчет</button>
</form>

<div id="residentapp">
    <router-view></router-view>
</div>

@endsection