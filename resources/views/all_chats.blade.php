@extends('layout_profile')

@section('title', 'Чаты')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection


@section('header')
    <span>{{ $minutes_balance }}</span>
@endsection


@section('content')
    <div class="info">
        <div class="chat-container">
            <h2>Ваши {{ $your_students_or_teachers }}</h2>

            @isset($interlocutors)
                <ul class="chat">
                    @foreach ($interlocutors as $interlocutor)
                        <a href="/chat/{{ $interlocutor['info'] }}">{{ $interlocutor['name'] }}</a>
                    @endforeach
                </ul>
            @else
                <p>у вас нет контактов</p>
            @endisset

        </div>
    </div>
@endsection
