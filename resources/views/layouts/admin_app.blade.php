<!DOCTYPE html>
<html lang="tw">
    <head>
        <meta charset="utf-8">
        <title>電商管理網站</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn">
        <script src="/js/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="></script>
        <script src="/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"></script>
        <script src="/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        <script src="/js/jquery.dataTables.js" ></script>
        <link rel="stylesheet" href="/css/app.css">

     <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    </head>
    <body id="page-top">
        <div id="wrapper">

            @include('layouts.admin_nav')

            <div id="content-wrapper" class="d-flex flex-column p-3 mt-3">
                        @yield('content')
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; 電商管理網站 2021</span>
                            </div>
                        </div>
                    </footer>

            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">

    </body>
    @stack('scripts')
</html>
