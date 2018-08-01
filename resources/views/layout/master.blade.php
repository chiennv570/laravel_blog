<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lap trinh Laravel - @yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        #wrapper {
            width: 980px;
            height: auto;
            margin: 0px auto;
        }

        #header {
            width: auto;
            height: 200px;
            background: red;
        }

        #content {
            width: auto;
            height: 500px;
            background: blue;
        }

        #footer {
            width: auto;
            height: 100px;
            background: green;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="header">
        @include('layout.marquee', ['mar_content' => 'Chao mung den voi khoa hoc']);
        @section('sidebar')
            Day la sidebar master
        @show
    </div>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer"></div>
</div>
</body>
</html>
