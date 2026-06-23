<!DOCTYPE html>
<html class="light" lang="id">
<head>
    @include('partials.head')
    <title>@yield('title', 'AngSoccer')</title>
</head>
<body class="@yield('body-class', 'bg-background font-body-md text-on-background min-h-screen')">
    @yield('content')

    @stack('scripts')
</body>
</html>