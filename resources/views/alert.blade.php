@extends('layout_profile')

@section('title', 'Уведомления')

@section('css')
    <style>
        .alert {
            position: relative;
            background-color: rgb(99, 92, 84);
            margin: 1em;
            padding: 1em 1em 2em;
            border-radius: 20px;
            width: 53vw;
        }
        
        .date_time {
            position: absolute;
            right: 5%;
            bottom: 5%;
            padding-top: .3em;
        }
        
        .red_alert::after {
            content: "";
            display: block;
            position: absolute;
            top: -5%;
            right: -1%;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
        }
        /* checkbox */
        
        .checkbox {
            margin: 2em 0 3em 2em;
            width: 66%;
            /*  */
            display: inline-block;
            position: relative;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        
        .checkbox input {
            display: none;
        }
        
        .checkbox input:checked~.checkbox_checkmark {
            background-color: #f7cb15;
        }
        
        .checkbox input:checked~.checkbox_checkmark:after {
            left: 21px;
        }
        
        .checkbox .checkbox_checkmark {
            position: absolute;
            top: 0;
            right: 0;
            height: 22px;
            width: 40px;
            background-color: #979797;
            -webkit-transition: background-color 0.25s ease;
            -o-transition: background-color 0.25s ease;
            transition: background-color 0.25s ease;
            border-radius: 11px;
        }
        
        .checkbox .checkbox_checkmark:after {
            content: "";
            position: absolute;
            left: 3px;
            top: 3px;
            width: 16px;
            height: 16px;
            display: block;
            background-color: #fff;
            border-radius: 50%;
            -webkit-transition: left 0.25s ease;
            -o-transition: left 0.25s ease;
            transition: left 0.25s ease;
        }
    </style>
@endsection

@section('header')
    <span>{{ $minutes_balance }}</span>
@endsection


@section('content')
    <div class="info">
        <h3>Уведомления</h3>       
        <form method="post">
            @csrf
            <label class="checkbox" for="permission_to_email">Отправлять уведомления на email:  
                    <input type="checkbox" name="permission_to_email" id="permission_to_email" {{ $value_permission == 1 ? 'checked' : '' }}>
                    <div class="checkbox_checkmark"></div>
            </label>
        </form>

        @foreach ($all_alert as $alert)
            <div class="alert @if(!$alert['seen']) red_alert @endif">
                {{ $alert['alert_text'] }}
                <span class="date_time"><b>{{ $alert['created_at'] }}</b></span>
            </div>
        @endforeach

    </div>
@endsection



@section('script')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type=checkbox]').on('change', function() {
                var isChecked = $(this).prop('checked');

                $.ajax({
                    url: '{{ route("permissions") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken
                    },
                    data: {
                        isChecked: isChecked ? 1 : 0
                    },
                });
            });
        });

    </script>
@endsection