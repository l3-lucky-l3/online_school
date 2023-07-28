@extends('template')

@section('title', 'Сбросить пароль')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
@endsection

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection


@section('html')
    <!--Reset Password | Сбросить пароль-->
    <div class="window_password">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif  
        <h2>Сбросить пароль</h2>
        <hr>
        <p>Забыли свой пароль? Введите свой адрес электронной почты ниже, и мы вышлем вам по электронной почте инструкции по настройке нового.</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autofocus />
            <button class="btn btn-primary" type="submit">Отправить ссылку для сброса пароля</button>
        </form>
    </div>
@endsection