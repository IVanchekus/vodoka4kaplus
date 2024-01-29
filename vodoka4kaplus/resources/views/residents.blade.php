@extends('layout')
@section('title') Дачники @endsection
@section('main')
<h1 class="mt-3">Список подключенных дачников</h1>

<div id="residentapp">
    <router-view></router-view>
</div>
@endsection