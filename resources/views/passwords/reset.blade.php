@extends('template')

@section('title', 'Сбросить пароль')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
@endsection

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection


@section('html')
    <!--Password Reset Confirm-->
    <div class="window_password">
        <h2>Подтверждение сброса пароля</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autofocus />

            @error('email')
                <div>{{ $message }}</div>
            @enderror

            <label for="password">Новый пароль:</label>
            <input type="password" id="password" name="password" required />

            <label for="password_confirmation">Подтверждение пароля:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required />
            
            <button type="submit">Сбросить пароль</button>
            
        </form>
    </div>
@endsection
