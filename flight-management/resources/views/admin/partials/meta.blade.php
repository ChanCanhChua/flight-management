<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/admin/common.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="{{asset('/js/libs/datatables.min.js')}}" ></script>
    <script defer type="module" src="{{asset('/js/libs/nice-select2.min.js')}}" ></script>
    <script defer  src="{{asset('/js/libs/flatpickr.js')}}" ></script>
    <script defer  src="{{asset('/js/libs/sweetalert2.all.min.js')}}" ></script>
    <script defer src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css">
    <script type="module" src="{{asset('/js/app.js')}}"></script>
    <script defer src="{{asset('/js/helper.js')}}" ></script>
    <script defer src="{{asset('/js/admin/global.js')}}"></script>
    <script defer src="{{asset('js/admin/user.js')}}"></script>
    <script defer src="{{asset('js/admin/login.js')}}"></script>
    @stack('head')
</head>
