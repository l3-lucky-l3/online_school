@extends('template')

@section('title', 'Поддержка')

@section('css')
    <style>
        textarea {
            margin: 1em 0 0 0;
            padding: 0.7em 0em 0.7em 4%;
            width: 96%;
            background-color: #242228;
            color: #fff;
            border: none;
        }
    </style>
@endsection

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection


@section('html')
    <section>
        <div class="window">
            <h3>Поддержка</h3>
            <form method="post" action="{{ route('support') }}">
                @csrf
                <label for="message">Сообщение:</label><br>
                <input type="text" id="message" name="message" required>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
