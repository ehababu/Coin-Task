<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('layouts.css')
    <style>
        
        body {
            margin: 20px;
            background: rgb(255, 255, 255);
        }

        div {
            margin-top: 10px;
        }
      
    </style>
</head>
<body>

    @yield('content')



    @include('layouts.js')
    @yield('script')
</body>
</html>