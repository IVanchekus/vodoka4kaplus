@extends('layout')
@section('title') Резидент @endsection
@section('main')
<h2 >{{ $resident->fio }}</h2>
<input type="text">
@endsection