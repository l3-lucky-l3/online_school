@extends('layout_profile')

@section('title', 'Пополнение баланса')

@section('header')
    <span>Осталось минут: {{ $minutes_balance }} мин.</span>
@endsection

@section('content')
    <div class="info">
        <h1>Пополнение баланса</h1>
        <form method="post" action="{{ route('replenish_balance') }}">
            @csrf
            <label for="amount">Сумма</label>
            <input type="number" min="1" name="amount">
            <button type="submit">Оплатить</button>
        </form>
    </div>
@endsection