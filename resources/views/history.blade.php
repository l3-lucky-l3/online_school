@extends('layout_profile')

@section('title', 'История занятий')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endsection

@section('header')
    <span>Баланс: {{ $minutes_balance }} руб.</span>
@endsection


@section('content')
    <div class="info">
        <h3>История</h3>

        @if ($all_history != [])
            @foreach ($all_history as $history)
                <div class="lesson">
                    @if ($user_role == "ученик")
                        <div class="see">
                            <p><b>Предмет:</b> {{ $history['subject'] }}</p>
                            <p><b>Время начала:</b> {{ $history['start_time'] }}</p>
                            <button class="detail">Подробнее</button>
                        </div>
                        <div class="more" style="display: none;">
                            <p><b>Перемена:</b> {{ $history['pause'] }} мин.</p>
                            <p><b>Продолжительность:</b> {{ $history['duration'] }}</p>
                            <p><b>Стоимость:</b> {{ $history['cost'] }} руб.</p>
                        </div>
                    @endif
                    
                    @if ($user_role == "преподаватель")
                        <div class="see">
                            <p><b>Имя:</b> {{ $history['student_name'] }}</p>
                            <p><b>Предмет:</b> {{ $history['subject'] }}</p>
                            <p><b>Класс:</b> {{ $history['number_class'] }}</p>
                            <button class="detail">Подробнее</button>
                        </div>
                        <div class="more" style="display: none;">
                            <p><b>Вопрос:</b> {{ $history['question'] }}</p>
                            <p><b>Время начала:</b> {{ $history['start_time'] }}</p>
                            <p><b>Продолжительность:</b> {{ $history['duration'] }}</p>
                            <p><b>Перемена:</b> {{ $history['pause'] }} мин.</p>
                            <p><b>Прибыль:</b> {{ $history['cost'] }} руб.</p>
                        </div>
                    @endif
                </div> 
            @endforeach
        @else
            <p class="applications">Нет истории</p>  
        @endif

    </div>
@endsection
