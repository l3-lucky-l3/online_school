@extends('template') 

@section('title', 'Изменить дополнительную информацию') 

@section('additional_header')
    <a href="/profile" class="backward"><i class="fa-solid fa-backward"></i></a>
@endsection 

@section('html')
    <div class="window">
        <h3>Изменить дополнительную информацию</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="form-input">
                <label for="id_question">Предметы:</label>
                <input type="text" name="teacher_subject" placeholder="Введите предметы" required=True value="{{ $teacher_subject }}">
            </div>

            <div class="form-input">
                <label for="id_question">Классы:</label>
                <input type="text" name="teacher_classes" placeholder="Введите классы" required=True value="{{ $teacher_classes }}">
            </div>

            <div class="form-input">
                <label for="id_question">Дополнительная информация:</label>
                <input type="text" name="teacher_comment" placeholder="Образование, опыт работы и т. д." required=True value="{{ $teacher_comment }}">
            </div>

            <button type="submit">Изменить данные</button>
        </form>
    </div>
@endsection