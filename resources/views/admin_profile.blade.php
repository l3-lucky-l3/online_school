@extends('layout_profile')

@section('header')
    <span>Панель администратора</span>
@endsection


@section('content')
    <div class="info">
        @if(session('success_confirm'))
            <div class="alert alert-success">
                {{ session('success_confirm') }}
            </div>
        @endif
        <h3>Подтверждение преподавателей</h3>
        <div class="applications">
            @if ($teacher_info != [])
                @foreach ($teacher_info as $info)
                    <div class="child">
                        <p><b>{{ $info['about_teacher']['first_name'] }} {{ $info['about_teacher']['last_name'] }}</b></p>
                        <p><b>Email:</b> {{ $info['about_teacher']['email'] }}</p>
                        <hr>
                        @isset($info['additional_information_teacher']['teacher_subject'])
                            <p><b>Предметы преподавания:</b> <br>{{ $info['additional_information_teacher']['teacher_subject'] }}</p>
                        @endisset

                        @isset($info['additional_information_teacher']['teacher_classes'])
                            <p><b>Классы:</b> <br>{{ $info['additional_information_teacher']['teacher_classes'] }}</p>
                        @endisset

                        @isset($info['additional_information_teacher']['teacher_comment'])
                            <p><b>Дополнительная информация:</b> <br>{{ $info['additional_information_teacher']['teacher_comment'] }}</p>
                        @endisset

                        <form method="post">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{ $info['teacher_id'] }}">
                            <button type="submit">Подтвердить</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>Нет заявок</p>
            @endif
        </div>
    </div>
@endsection
