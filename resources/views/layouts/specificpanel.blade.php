<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VOCA - Sistema de Painel de Chamada</title>

    {{--arquivos de CSS necessários--}}
    @include('css_required/css')

    {{--section para css--}}
    @yield('styles')

</head>

<body class="app header-fixed sidebar-scroll aside-menu-fixed pace-done sidebar-lg-show">

    <div class="app-body">

        <main class="main">

            <div style="padding-top: 20px" class="container-fluid">

                {{--conteúdo--}}
                @yield('content')

            </div>

        </main>

    </div>

    {{-- Arquivos de JS necessários--}}
    @include('js_required/js')

    <script>

    </script>
    @yield('scripts')

</body>

</html>
