@extends('layout_profile')

@section('title', 'Работа')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/work.css') }}">
@endsection

@section('header')
    <span>Баланс: {{ $minutes_balance }} руб.</span>
@endsection


@section('content')
    @empty($account_confirmation)
        <div class="confirmation">
            Учётная запись НЕ подтверждена.
            <br>Пожалуйста заполните информацию 
            <a href="{{ route('change_additional_information') }}">о себе</a> 
            и дождитесь подтверждения записи(макс 10 дней) или обратитель в 
            <a href="{{ route('support') }}">поддержку</a>.
        </div>
    @else
    
    <div class="info info_work">

        <form method="get" action="{{ route('work_filter') }}" class="search_form">
            <div>
                <label for="user_class">Класс:</label>
                <input type="number" min="1" max="11" name="user_class" placeholder="Введите класс">
            </div>
            <div>
                <label for="user_subject">Предмет:</label>
                <select id="user_subject" name="user_subject">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject }}">{{ $subject }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="search_btn">Искать...</button>
        </form>

        @if(isset($get_data['user_class']) && isset($get_data['user_subject']))
            <div class="div_filter">Фильтр:
                <p>@isset ($get_data['user_class']) класс: {{ $get_data['user_class'] }} @endisset</p>
                <p>@isset ($get_data['user_subject']) предмет: {{ $get_data['user_subject'] }} @endisset</p>
            </div>
        @endif

        @if ($all_lessons != [])
            @foreach($all_lessons as $lesson)
                <div class="lesson">
                    <p class="question">{{ $lesson['question'] }}</p>
                    <hr>
                    <p class="subject"><b>Предмет:</b> {{ $lesson['subject'] }}</p>
                    <div class="class_detail">
                        <span class="class"><b>Класс:</b> {{ $lesson['number_class'] }}</span>
                        <button class="detail">Подробнее</button>
                    </div>
                    <div class="more" style="display: none;">
                        <p><b>Имя ученика:</b> {{ $lesson['name'] }}</p>
                        <p><b>Время начала:</b> {{ $lesson['start_time'] }}</p>
                        <p><b>Перемена:</b> {{ $lesson['pause'] }}</p>
                        <p><b>Продолжительность:</b> {{ $lesson['duration'] }} мин.</p>
                        <p><b>Прибыль:</b> {{ $lesson['cost'] * env('COEFFICIENT_PAYMENT_TEACHER') }} руб.</p>
                    </div>


                    <form method="post" action="{{ route('work') }}">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $lesson['id'] }}">
                        <input type="hidden" name="user_id" value="{{ $lesson['user_id'] }}">
                        <input type="hidden" name="question" value="{{ $lesson['question'] }}">
                        <input type="hidden" name="number_class" value="{{ $lesson['number_class'] }}">
                        <input type="hidden" name="student_name" value="{{ $lesson['name'] }}">
                        <input type="hidden" name="subject" value="{{ $lesson['subject'] }}">
                        <input type="hidden" name="start_time" value="{{ $lesson['start_time'] }}">
                        <input type="hidden" name="pause" value="{{ $lesson['pause'] }}">
                        <input type="hidden" name="duration" value="{{ $lesson['duration'] }}">
                        <button type="submit" class="take">Принять</button>
                    </form>

                </div>
            @endforeach
        @else
        <p>Нет уроков</p>
        @endif
    </div>

    <script>
        document.querySelector('.info').style.maxHeight = 'max-content';
    </script>
    @endempty
   
@endsection