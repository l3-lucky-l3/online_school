@extends('layout_profile')

@section('title', 'Учёба')

@section('header')
    <span>Осталось минут: {{ $minutes_balance }} мин.</span>
@endsection


@section('content')
    <div class="info">

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('study') }}" method="post">
            @csrf
            <div class="form-input">
                <label for="id_question">Вопрос:</label>
                <input type="text" name="question" maxlength="255" id="id_question" placeholder="Введите вопрос" required=True>
            </div>
            <div class="form-input">
                <label for="id_class">Класс:</label>
                <input type="number" min="1" max="11" name="number_class" id="id_class" placeholder="Введите свой класс" required=True>
            </div>
            <div class="form-input">
                <label for="id_subject">Предмет:</label>
                <select name="subject" id="id_subject">
                    @foreach($all_sub as $sub)
                        <option value="{{ $sub }}">{{ $sub }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-input">
                <label for="id_start_time">Начало занятия(введите время по МСК):</label>
                <input type="datetime-local" name="start_time" id="id_start_time" required=True>
            </div>
            <div class="form-input">
                <label for="duration">Продолжительность занятия:</label>
                <input type="number" name="duration" id="duration" required=True placeholder="Введите продолжительность занятия(в минутах)">
            </div>
            <div class="form-input">
                <label for="id_pause">Перемена:</label>
                <input type="number" min="0" name="pause" step="1" value="0" id="id_pause" placeholder="Введите время перемены(в минутах)">
            </div>
            <button type="submit" style="margin-bottom: 0;">Создать</button>
        </form>
    </div>
@endsection
