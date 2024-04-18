<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/main.js') }}" ></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    @auth
    {{-- navbar --}}
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" style="margin-left: 10px;" href="#">
            <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776;</span>
        </a>
      </nav>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" style="margin: -1rem 0 0 10rem;font-size:30px;cursor:pointer"onclick="closeNav()">&times;</a>
        <a class="nav-link" href="{{url('home')}}">Home</a>
        <a class="nav-link" href="{{url('assign')}}">Users</a>
        <a class="nav-link" href="{{url('permissions')}}">Permissions</a>
        <a class="nav-link" href="{{url('roles')}}">Roles</a>
        <a class="nav-link" href="{{url('workflowSteps')}}">Workflow Steps</a>
        <a class="nav-link" href="{{url('services')}}">Services</a>
        <a class="nav-link" href="{{url('customers')}}">Customer</a>
        <a class="nav-link" href="{{url('properties')}}">Property</a>
        <a class="nav-link" href="{{url('workflow')}}">Workflow</a>
        <a class="nav-link" href="{{url('transaction')}}">Transaction</a>
        <a class="nav-link" href="{{url('claim-task')}}">Worksheet</a>
        {{-- <a class="nav-link" href="{{url('payment')}}">Payment</a> --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="log-out">
              <a><i class="fa-solid fa-right-from-bracket"></i><button type="submit">Logout</button></a>
            </div>
        </form>
    </div>
    {{-- navbar --}}

    @endauth
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
