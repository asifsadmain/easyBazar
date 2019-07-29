<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EasyBazar</title>

        <!-- Fonts -->
        <link href="{{ asset('css/personal.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url("/uploads/background.jpg");
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

<div>
    <nav  id="nav" class="navbar navbar-expand-md navbar-light shadow-sm">
        <a id="brand2" class="navbar-brand" href="/"><font size="8"> EasyBazar </font></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item">
                        <a id="brand" class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>  
            @else
                    <li class="nav-item">
                        <a id="brand" class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a id="brand" class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
            @endif
                    @endauth
                </ul>
            @endif
        </div>
    </nav>
</div>


    <br><br>
    <div>
        <h1 class="display-1 text-center text-secondary"> Welcome to EasyBazar</h1>
        <h3 class="text-center font-italic text-secondary">The most trustworthy online buy and sell platform for you</h3>
    </div><br><br><br>
    @extends('layouts.showCategory')

</html>