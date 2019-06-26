@include('theme::partials.head')

@section('app')
  <div id="app" data-app class="app">
    @stack('before:main')

    @section('main')
      <main id="main" data-main class="main">
        @stack('before:page')

        @yield('page')

        @stack('after:page')
      </main>
    @show

    @stack('after:main')
  </div>
@show

@include('theme::debug.debugbar')
@include('theme::partials.foot')
