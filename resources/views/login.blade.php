@extends('template')

@section('title', 'Войти')

@section('html')
    <section>
        <div class="window">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h3>Авторизация</h3>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
                
                <label for="password">Пароль:</label><br>
                <input type="password" id="password" name="password" required><br><br>   
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
                
                <div class="reset">
                    <a href="{{ route('password.request') }}">Забыли пароль?</a>
                </div>

                <button type="submit">Войти</button>
            </form>
            <div class="hint">
                <span>У вас нет акаунта?</span>
                <a href="{{ route('register') }}">Зарегистрирутесь!</a>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script>
        document.getElementsByName('username')[0].placeholder = 'Введите логин';
        document.getElementsByName('password')[0].placeholder = 'Введите пароль';
    </script>
@endsection
