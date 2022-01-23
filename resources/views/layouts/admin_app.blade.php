<html>
    <head>
        <title>電商管理網站</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="></script>
        <script src="/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"></script>
        <script src="/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        <script src="/js/jquery.dataTables.js" ></script>
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        @include('layouts.admin_nav')
        <div>
            @yield('content')
        </div>
    </body>
    @stack('scripts')
</html>
