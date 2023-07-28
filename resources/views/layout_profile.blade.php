@extends('template')

@section('title', 'Профиль')

@section('additional_header')
    <button class="phone_open_panel"><i class="fa-solid fa-bars fa-2x"></i></button>
@endsection

@section('html')
<div class="main">
    <div class="panel">
        <div class="items open">
            <a><i class="fa-solid fa-user"></i></a>
        </div>
        @foreach($hrefs_icons_texts as $href_icon)
            <div class="items">
                <a href="{{ $href_icon['href'] }}"><i class="fa-solid {{ $href_icon['icon'] }}"></i></a>
            </div>
        @endforeach
        <div class="items @isset($alert_exist) alert_point @endisset">
            <a href="/alert"><i class="fa-solid fa-bell"></i></a>
        </div>
        <div class="items support">
            <a href="{{ route('support') }}"><i class="fa-solid fa-headset"></i></a>
        </div>
        <div class="items exit">
            <a href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
    </div>

    <div class="sidebar">
        <div class="back"><i class="fa-solid fa-xmark fa-2x"></i></div>
        <h2>
            <a href="{{ route('profile') }}">{{ $user['username'] }}</a>
        </h2>
        @foreach($hrefs_icons_texts as $href_text)
            <div class="items">
                <a href="{{ $href_text['href'] }}">{{ $href_text['text'] }}</a>
            </div>
        @endforeach
        <div class="items @if($alert_exist) alert_point @endif">
            <a href="/alert">Уведомления</a>
        </div>
        <div class="items support">
            <a href="{{ route('support') }}">Поддержка</a>
        </div>
        <div class="items exit">
            <a href="{{ route('logout') }}">Выйти</a>
        </div>
    </div>

    
    <section>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </section>




</div>

<script>
    document.querySelector('.phone_open_panel').addEventListener('click', () => {
        document.querySelector('.sidebar').classList.toggle('sidebar_show');
        document.querySelector('.fa-solid').classList.toggle('fa-xmark');
        document.querySelector('.fa-solid').classList.toggle('fa-bars');
    });

    document.querySelector('.back').addEventListener('click', () => {
        document.querySelector('.sidebar').style.transform = 'translateX(-44vw)';
        document.querySelector('.info').style.transform = 'translateX(-22vw)';

        document.querySelector('.info').classList.add('hide-scrollbar');
    });

    document.querySelector('.open').addEventListener('click', () => {
        document.querySelector('.sidebar').style.transform = 'translateX(0)';
        document.querySelector('.info').style.transform = 'translateX(0)';

        document.querySelector('.info').classList.remove('hide-scrollbar');
    });



    document.querySelectorAll(".lesson").forEach((lesson) => {
        const moreDiv = lesson.querySelector(".more");

        lesson.querySelector(".detail").addEventListener("click", (btn) => {
            if (moreDiv.style.display === "none") {
                moreDiv.style.display = "block";
                lesson.querySelector(".detail").textContent = 'Скрыть';
            } else {
                moreDiv.style.display = "none";
                lesson.querySelector(".detail").textContent = 'Подробнее';
            }
        });
    });
</script>
@endsection
