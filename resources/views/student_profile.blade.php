@extends('layout_profile')

@section('header')
    <span>Осталось минут: {{ $minutes_balance }} мин.</span>
@endsection


@section('content')
    <div class="info">
        @if(session('success_lesson_create'))
            <div class="alert-success">
                {{ session('success_lesson_create') }}
            </div>
        @endif
        <div class="about_user">
            <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
            <div>Username: {{ $user->username }}</div>
            <div>Роль: {{ $user->role }}</div>
            <div>Email: {{ $user->email }}</div>
        </div>

        <button onclick="location.href = `{{ route('change_user') }}`" class="btn_change">Изменить данные пользователя</button>
        <button onclick="location.href = `{{ route('update_password') }}`" class="btn_change">Изменить пароль</button>
    </div>
@endsection
