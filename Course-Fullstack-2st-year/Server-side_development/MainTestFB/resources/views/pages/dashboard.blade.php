@extends('layouts.app')
@section('title', 'Рабочий стол')

@section('content')
    <h2>Добро пожаловать, {{ auth()->user()->name }}!</h2>
    <p>Здесь будет ваш рабочий стол.</p>
    <a href="{{ route('logout.form') }}" class="btn btn-secondary">Выход</a>

@endsection
