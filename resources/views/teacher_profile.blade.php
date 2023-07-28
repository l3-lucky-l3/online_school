@extends('layout_profile')

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
        @endempty

        <div class="info">
            <div class="about_user">
                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                <div>Username: {{ $user->username }}</div>
                <div>Роль: {{ $user->role }}</div>
                <div>Email: {{ $user->email }}</div>
                <div><b>О себе:</b>
                    <ul class="ul_about_me">
                        <li><b>Предметы:</b> {{ $about_me['teacher_subject'] }}</li>
                        <li><b>Классы:</b> {{ $about_me['teacher_classes'] }}</li>
                        <li><b>Доп информация:</b> {{ $about_me['teacher_comment'] }}</li>
                    </ul>
                </div>
            </div>

        <button onclick="location.href = `{{ route('change_user') }}`" class="btn_change">Изменить данные пользователя</button>
        <button onclick="location.href = `{{ route('update_password') }}`" class="btn_change">Изменить пароль</button>
        <button onclick="location.href = `{{ route('change_additional_information') }}`" class="btn_change">Изменить дополнительную информацию</button>
    </div>
@endsection



@section('script')

    @isset($account_confirmation)
        <script>
            document.querySelector('.info').style.maxHeight = '80.8vh';
            document.querySelector('.info').style.paddingBottom = '0';
        </script>
    @else
        <script>
            document.querySelector('.info').style.maxHeight = '64vh';
        </script>
    @endisset

@endsection
