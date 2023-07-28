<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#6c5bd5">
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#ffffff') }}">
    <meta name="msapplication-config" content="{{ asset('img/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- title -->
    <title>Онлайн школа "Виртуальная Мудрость"</title>

    <!-- style -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="disclaimer">
        <div>
            <h1>Дисклеймер</h1>
            <p>Весь материал, размещенный на этом сайте, предназначен исключительно для информационных целей. Автор не несет ответственности за использование данной информации любыми лицами и не гарантирует ее полноту и точность.</p>
            <p>Пользователь соглашается, что использование данного сайта и всей представленной на нем информации выполняется только на свой страх и риск.</p>
            <p>Мы используем файлы cookie на нашем сайте, чтобы улучшить ваш опыт взаимодействия с нашими услугами. Если вы не хотите получать файлы cookie, вы можете изменить настройки на вашем браузере, чтобы отключить их при использовании нашего сайта.
                Однако это может привести к некоторым ограничениям в функциональности сайта.</p>
            <p>Если у вас есть вопросы или предложения по улучшению сайта, пожалуйста, обратитесь к автору через форму обратной связи.</p>
            <button class="agreement">Ок</button>
        </div>
    </div>


    <header>
        <nav>
            <div class="logo"><img src="{{ asset('img/logo.PNG') }}" alt="logo"></div>
            <div class="slogan">
                <h3>Виртуальная Мудрость - Получите знания, которые вам нужны!</h3>
            </div>
            <div class="navigation">
                <a href="{{ route('login') }}">Войти</a>
                <hr> <a href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        </nav>
    </header>


    <main>
        <section id="offer">

            <h1 class="phone_slogan">Виртуальная Мудрость - Получите знания, которые вам нужны!</h1>

            <h2>Что мы предлагаем</h2>
            <div class="offer_box animate animate_from_left">
                <h3>Обучение онлайн</h3>
                <p>Мы предлагаем онлайн обучение по самым разным направлениям. Выберите то, что вас интересует, и начните учиться прямо сейчас.</p>
            </div>
            <div class="offer_box animate animate_up">
                <h3>Лучшие преподаватели</h3>
                <p>В нашей школе работают только опытные преподаватели, которые готовы помочь вам в изучении любой темы.</p>
            </div>
            <div class="offer_box animate animate_from_right">
                <h3>Гибкий график</h3>
                <p>У вас нет времени на полноценное обучение? Не беда! Мы предлагаем гибкий график, чтобы вы могли учиться в любое время и в любом месте.</p>
            </div>
        </section>

        <section id="about_us">
            <h2>О нас</h2>
            <div class="facts">
                <div class="fact">
                    <div class="number">1500</div>
                    <p>Студентов уже прошли наши курсы</p>
                </div>
                <div class="fact">
                    <div class="number">300</div>
                    <p>Опытных преподавателей</p>
                </div>
                <div class="fact">
                    <div class="number">90%</div>
                    <p>Наших выпускников трудоустроены</p>
                </div>
            </div>
        </section>

        <section id="reviews">
            <h2>Отзывы наших учеников</h2>
            <div class="offer_box animate animate_shaking">
                <q>Онлайн школа "Виртуальная Мудрость" помогла мне освоить новый профессиональный навык, который был мне необходим в работе. Обучение прошло интересно и познавательно. Рекомендую!</q>
                <p>- Артём Беспалов, ученик онлайн-школы "Виртуальная Мудрость"</p>
            </div>
            <div class="offer_box animate animate_rotation_left">
                <q>Я обучаюсь в Онлайн школе "Виртуальная Мудрость" уже 3 месяца и совершенно точно не пожалел о своем выборе. Благодаря онлайн формату, я могу учиться даже во время командировок.</q>
                <p>- Иван Иванов, ученик онлайн-школы "Виртуальная Мудрость"</p>
            </div>
        </section>


        <section id="mailing">
            <h2>Поддержка</h2>
            <form method="post">
                @csrf
                <div>
                    <label for="message">Сообщение:</label><br>
                    <input type="text" id="message" name="message" required>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>

                    <button type="submit">Отправить</button>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </section>


        <footer>
            <p>8 (800) 000-00-00</p>
            <p>support@VirtualWisdom.ru</p>
            <p>© 2023 Virtual Wisdom. Все права защищены.</p>
        </footer>
    </main>

    @if(session('success'))
        <script>
            window.onload = function() {
                var scrollingElement = document.getElementById("mailing");
                if (scrollingElement) {
                    scrollingElement.scrollIntoView();
                }
            }
        </script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
    <script>
        // cookie | disclaimer
        if (Cookies.get("disclaimer") === "agree") {
            document.querySelector('.disclaimer').style.display = 'none';
        }

        document.querySelector('.agreement').addEventListener('click', () => {
            document.querySelector('.disclaimer').style.display = 'none';
            
            let expires = new Date();
            expires.setDate(expires.getDate() + 150);
            Cookies.set("disclaimer", "agree", { expires: expires });
        });
        

        const factsDivs = document.querySelectorAll('.fact');

        setTimeout(() => {
            factsDivs[0].style.transform = 'translateY(-10px)';
            factsDivs[1].style.transform = 'translateY(0px)';
            factsDivs[2].style.transform = 'translateY(0px)';
            setTimeout(() => {
                factsDivs[0].style.transform = 'translateY(0px)';
                factsDivs[1].style.transform = 'translateY(-10px)';
                factsDivs[2].style.transform = 'translateY(0px)';
                setTimeout(() => {
                    factsDivs[0].style.transform = 'translateY(0px)';
                    factsDivs[1].style.transform = 'translateY(0px)';
                    factsDivs[2].style.transform = 'translateY(-10px)';
                }, 1000);
            }, 1000);
        }, 1000);

        setInterval(() => {
            setTimeout(() => {
                factsDivs[0].style.transform = 'translateY(-10px)';
                factsDivs[1].style.transform = 'translateY(0px)';
                factsDivs[2].style.transform = 'translateY(0px)';
                setTimeout(() => {
                    factsDivs[0].style.transform = 'translateY(0px)';
                    factsDivs[1].style.transform = 'translateY(-10px)';
                    factsDivs[2].style.transform = 'translateY(0px)';
                    setTimeout(() => {
                        factsDivs[0].style.transform = 'translateY(0px)';
                        factsDivs[1].style.transform = 'translateY(0px)';
                        factsDivs[2].style.transform = 'translateY(-10px)';
                    }, 1000);
                }, 1000);
            }, 1000);
        }, 3000);
    </script>
</body>

</html>