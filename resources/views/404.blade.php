<!DOCTYPE html>
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
    <title>Страница не найдена</title>

    <!-- style -->
    <style>
        * {
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }
        
        section {
            box-sizing: border-box;
            width: 100%;
            height: 100vh;
            background-image: -webkit-gradient(linear, left bottom, left top, from(#2e1753), color-stop(#1f1746), color-stop(#131537), color-stop(#0d1028), to(#050819));
            background-image: -o-linear-gradient(bottom, #2e1753, #1f1746, #131537, #0d1028, #050819);
            background-image: linear-gradient(to top, #2e1753, #1f1746, #131537, #0d1028, #050819);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: #fff;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            overflow: hidden;
        }
        
        .error_text,
        .error_text_2 {
            position: absolute;
            font-size: 28pt;
            text-align: center;
        }
        
        .error_text {
            top: 20%;
        }
        
        .error_text_2 {
            top: 70%;
        }
        
        .error_text_2>a {
            color: #fff;
        }
        
        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #fff;
            right: 0;
            -webkit-animation: starTwinkle 3s infinite linear;
            animation: starTwinkle 3s infinite linear;
        }
        
        @-webkit-keyframes starTwinkle {
            0% {
                background: rgba(255, 255, 255, 0.4);
            }
            25% {
                background: rgba(255, 255, 255, 0.8);
            }
            50% {
                background: rgba(255, 255, 255, 1);
            }
            75% {
                background: rgba(255, 255, 255, 0.8);
            }
            100% {
                background: rgba(255, 255, 255, 0.4);
            }
        }
        
        @keyframes starTwinkle {
            0% {
                background: rgba(255, 255, 255, 0.4);
            }
            25% {
                background: rgba(255, 255, 255, 0.8);
            }
            50% {
                background: rgba(255, 255, 255, 1);
            }
            75% {
                background: rgba(255, 255, 255, 0.8);
            }
            100% {
                background: rgba(255, 255, 255, 0.4);
            }
        }
        /* moon */
        
        .container {
            height: 60%;
            width: 60%;
            position: absolute;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
        }
        
        p.letter {
            font-size: 7.5em;
            position: absolute;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            top: 50%;
        }
        
        .letter-left {
            left: 0.7em;
        }
        
        .letter-right {
            right: 0.7em;
        }
        
        .moon {
            border: 1em solid #f5f5f5;
            height: 8em;
            width: 8em;
            border-radius: 50%;
            position: absolute;
            margin: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            -webkit-box-shadow: 0 0 0 0.6em rgba(255, 255, 255, 0.05), 0 0 0 1.2em rgba(255, 255, 255, 0.05), 0 0 0 1.8em rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 0.6em rgba(255, 255, 255, 0.05), 0 0 0 1.2em rgba(255, 255, 255, 0.05), 0 0 0 1.8em rgba(255, 255, 255, 0.05);
        }
        
        .moon:after {
            position: absolute;
            content: "";
            background-color: #e6e6e6;
            height: 0.9em;
            width: 0.9em;
            border-radius: 50%;
            top: 3.75em;
            left: 1.25em;
            -webkit-box-shadow: -0.1em -2.1em 0 0.15em #e6e6e6, 1.7em 0.7em 0 -0.06em #e6e6e6, 2em -3em 0 -0.09em #e6e6e6, 3em -1.3em 0 0.04em #e6e6e6;
            box-shadow: -0.1em -2.1em 0 0.15em #e6e6e6, 1.7em 0.7em 0 -0.06em #e6e6e6, 2em -3em 0 -0.09em #e6e6e6, 3em -1.3em 0 0.04em #e6e6e6;
        }
        
        @media screen and (max-width: 400px) {
            .error_text {
                top: 8% !important;
            }
            .error {
                margin-top: 1em;
            }
            .container {
                width: 132vw !important;
            }
        }
    </style>
</head>

<body>

    <section>
        <div class="error_text">
            <div>Страница не найдена</div>
            <hr>
            <div class="error">ОШИБКА</div>
        </div>

        <div class="container">
            <p class="letter letter-left">4</p>
            <div class="moon"></div>
            <p class="letter letter-right">4</p>
        </div>

        <div class="error_text_2">
            <a href="{{ route('main') }}">Вернуться</a>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var body = document.body;

            function createStar() {

                var numStars = document.querySelectorAll('div.star').length;
                if (numStars < 14) {
                    var right = Math.random() * 500;
                    var top = Math.random() * screen.height;
                    var star = document.createElement("div");
                    star.classList.add("star")
                    document.body.appendChild(star);
                    setInterval(runStar, 10);
                    star.style.top = top + "px";

                    function runStar() {
                        if (right >= screen.width) {
                            star.remove();
                        }
                        right += 2;
                        star.style.right = right + "px";
                    }
                }
            }

            setInterval(createStar, 100);
        });
    </script>
</body>

</html>