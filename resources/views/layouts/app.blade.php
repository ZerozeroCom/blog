<html>
    <head>
        <title>電商網站</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn">
        <script src="js/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="></script>
        <script src="js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"></script>
        <script src="js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"></script>
        <script src="https://unpkg.com/vue@next"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </head>
    <body>
        @include('layouts.nav')
        <div>
            @yield('content')
        </div>
    </body>
</html>
