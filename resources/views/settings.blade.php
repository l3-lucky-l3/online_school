@extends('layout_profile')

@section('title', 'Настройки')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('header')
    <span>Панель администратора</span>
@endsection


@section('content')

    @if(session('success_admin'))
        <div class="alert alert-success">
            {{ session('success_admin') }}
        </div>
    @endif

    <div class="info info_settings">
        <div class="subject">
            <h3>Предметы</h3>
            <form method="post" action="{{ route('settings.add_subject') }}" class="form_add">
                @csrf
                <label for="subject">Добавить предмет:</label><br>
                <input type="text" id="subject" name="subject" required><br><br>
                <button type="submit">Добавить</button>
            </form>
            <ul>
                @foreach ($subjects as $subject)
                    <li>
                        <form method="post" action="{{ route('settings.delete_subject') }}" class="form_subject"> 
                            @csrf
                            <span>{{ $subject['subject'] }}</span>
                            <input type="hidden" name="subject" value="{{ $subject['subject'] }}" required>
                            <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="classes">
            <h3>Классы</h3>
            <form method="post" action="{{ route('settings.add_class') }}" class="form_add">
                @csrf
                <label for="num_class">Добавить класс:</label><br>
                <input type="number" min="1" max="11" id="num_class" name="num_class" required><br><br>
                <button type="submit">Добавить</button>
            </form>
            <ul>
                @foreach ($number_class as $num_class)
                    <li>
                        <form method="post" action="{{ route('settings.delete_class') }}" class="form_subject"> 
                            @csrf
                            <span>{{ $num_class['num_class'] }}</span>
                            <input type="hidden" name="num_class" value="{{ $num_class['num_class'] }}" required>
                            <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="price">
            <h3>Стоимость минуты</h3>
            <form method="post" action="{{ route('settings.change_minute_cost') }}" class="form_add">
                @csrf
                <label for="minute_cost">Изменить стоимость:</label><br>
                <input type="hidden" name="last_minute_cost" value="{{ $minute_cost['minute_cost'] }}">
                <input type="number" name="minute_cost" value="{{ $minute_cost['minute_cost'] }}">
                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection