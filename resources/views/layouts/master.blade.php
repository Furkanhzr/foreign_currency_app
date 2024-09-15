<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: #343a40;
            padding: 10px 0;
            color: white;
            box-shadow: 0 4px 2px -2px gray;
        }
        header .navbar-brand {
            font-size: 1.5rem;
        }
        header .nav-link {
            color: white;
            margin-right: 15px;
        }
        header .nav-link:hover {
            color: #ffc107;
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /*transition: all 0.3s ease-in-out;*/
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
        }
        .btn {
            background-color: #343a40;
            color: white;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }
        .btn:hover {
            background-color: #495057;
        }
        /* Output Result Box */
        .result {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            font-size: 1.2rem;
            color: #495057;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /*transition: all 0.3s ease-in-out;*/
        }
        .result.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .result.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .result.fade {
            opacity: 0.5;
        }

        /* döviz */

        .exchange-rate-bar {
            background-color: #343a40;
            padding: 10px;
            color: white;
            text-align: center;
            box-shadow: 0 4px 2px -2px gray;
            font-size: 1.2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .exchange-rate-bar h2 {
            display: inline-block;
            margin: 0 20px;
            font-size: 1.5rem;
            color: white;
        }

        .exchange-rate-bar h2 span {
            font-weight: bold;
            color: #ffc107;
        }

        .up {
            background-color: green;
            animation: flashGreen 1s ease-out;
        }

        .down {
            background-color: red;
            animation: flashRed 1s ease-out;
        }

        @keyframes flashGreen {
            0% { background-color: green; }
            100% { background-color: transparent; }
        }

        @keyframes flashRed {
            0% { background-color: red; }
            100% { background-color: transparent; }
        }

        .exchange-rate {
            font-size: 1.3rem;
            margin-left: 10px;
        }
    </style>
    <title>@yield('title')</title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">Döviz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Anasayfa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    @yield('content')
</div>



</body>
</html>
