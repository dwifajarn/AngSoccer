@extends('layouts.app')

@section('content')
    @yield('background')

    <main class="@yield('main-class', 'w-full max-w-[440px] flex flex-col items-center mx-auto z-10')">
        @yield('main')
    </main>

    @hasSection('footer')
        @yield('footer')
    @endif
@endsection