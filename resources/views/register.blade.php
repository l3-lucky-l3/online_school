@extends('template')

@section('title', 'Зарегистрироваться')


@section('html')
    <div class="window">
        <h3>Регистрация</h3>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label for="first_name">Имя:</label><br>
            <input type="text" id="first_name" name="first_name" required><br><br>
            @error('first_name')
                <div>{{ $message }}</div>
            @enderror
    
            <label for="last_name">Фамилия:</label><br>
            <input type="text" id="last_name" name="last_name" required><br><br>
            @error('last_name')
                <div>{{ $message }}</div>
            @enderror

            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            @error('username')
                <div>{{ $message }}</div>
            @enderror
            
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

            <label for="confirm-password">Повторите пароль:</label>
            <input type="password" id="confirm-password" name="confirm-password" required><br><br>
            @error('confirm-password')
                <div>{{ $message }}</div>
            @enderror

            <label for="role">Роль:</label><br>
            <select id="role" name="role">
                <option value="ученик">Ученик</option>
                <option value="преподаватель">Преподаватель</option>
            </select>
            @error('role')
                <div>{{ $message }}</div>
            @enderror
            
            <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="hint">
            <a href="{{ route('login') }}">Войти</a>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.getElementsByName('first_name')[0].placeholder = 'Введите имя';
        document.getElementsByName('last_name')[0].placeholder = 'Введите фамилию';
        try {
            let number_class = document.getElementsByName('number_class')[0];
            number_class.placeholder = 'Введите класс';
            number_class.max = 11;
            number_class.min = 1;
        } catch {}
        document.getElementsByName('username')[0].placeholder = 'Введите логин';
        document.getElementsByName('email')[0].placeholder = 'Введите email';
        document.getElementsByName('password1')[0].placeholder = 'Введите пароль';
        document.getElementsByName('password2')[0].placeholder = 'Повторите пароль';
        try {
            document.getElementsByName('role')[0].placeholder = 'Выберите роль';
        } catch {}
        document.getElementsByName('captcha_1')[0].placeholder = 'Введите код с картинки';
    </script>
@endsection
