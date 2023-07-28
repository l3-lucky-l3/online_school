@extends('template') 

@section('title', 'Изменить данные') 

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection 

@section('html')
    <div class="window">
        <h3>Изменить профиль</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="form-input">
                <label for="new_first_name">Изменить имя:</label>
                <input type="text" name="new_first_name" id="new_first_name" placeholder="Введите имя" required=True value="{{ $user['first_name'] }}">
            </div>

            <div class="form-input">
                <label for="new_last_name">Изменить фамилию:</label>
                <input type="text" name="new_last_name" id="new_last_name" placeholder="Введите фамилию" required=True value="{{ $user['last_name'] }}">
            </div>

            <div class="form-input">
                <label for="new_username">Изменить username:</label>
                <input type="text" name="new_username" id="new_username" placeholder="Введите username" required=True value="{{ $user['username'] }}">
            </div>

            <div class="form-input">
                <label for="new_email">Изменить email:</label>
                <input type="text" name="new_email" id="new_email" placeholder="Введите email" required=True value="{{ $user['email'] }}">
            </div>

            <button type="submit">Изменить данные</button>
        </form>
    </div>
@endsection