@extends('template') 

@section('title', 'Изменить пароль') 

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection 

@section('html')
    <div class="window">
        <h3>Изменить пароль</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method="post">
            @csrf
            <label for="current_password">Текущий пароль:</label>
            <input type="password" id="current_password" name="current_password" required>
        
            <label for="new_password">Новый пароль:</label>
            <input type="password" id="new_password" name="new_password" required>
        
            <button type="submit">Изменить пароль</button>
        </form>     
    </div>
@endsection