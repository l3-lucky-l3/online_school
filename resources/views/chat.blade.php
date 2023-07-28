@extends('layout_profile')

@section('title', 'Чат')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection


@section('header')
    <span>{{ $minutes_balance }}</span>
@endsection


@section('content')
    <div class="info">
        <div class="chat-container">
            <h2>Чат с {{ $receiver_first_name }} {{ $receiver_last_name }}</h2>
            <ul class="chat">
                @foreach ($messages as $message)                
                    @if ($message['sender_id'] == $current_user_id)
                        <li class="message right">
                            <p>{{ $message['message_text'] }}</p>
                        </li>
                    @else
                        <li class="message left">
                            <p><b>{{ $receiver_first_name }}:</b> {{ $message['message_text'] }}</p>
                        </li>
                    @endif  
                @endforeach
            </ul>
            <form action="{{ route('chat') }}" method="post">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user_id }}">
                <input type="text" name="message_text" placeholder="Сообщение..." />
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        window.addEventListener('load', function() {
            var chat = document.querySelector('.chat');
            chat.scrollTop = chat.scrollHeight;
        });
    </script>
@endsection
