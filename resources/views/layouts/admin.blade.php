@extends('layouts::master')

@section('app')
  <div id="app" data-app class="app">
    @section('app:sidebar')
      <!-- sidebar -->
      @include('theme::sidebar.sidebar')
      <!-- sidebar -->
    @show

    @section('workspace')
      <div id="workspace" class="workspace" data-workspace>
        <!-- utilitybar -->
        @include('theme::partials.utilitybar')
        <!-- utilitybar -->

        <!-- breadcrumbs -->
        @section('app:breadcrumbs')
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-0">
                @include('theme::partials.breadcrumbs')
              </div>
            </div>
          </div>
        @show
        <!-- breadcrumbs -->

        <!-- main -->
        <main id="main" role="main" class="main">
          @section('main')
            <div class="container">
              <div class="row">
                <div class="col-12">
                  @section('page')
                    @section('page:header')
                      @header
                        @slot('title')
                          @yield('page:title')
                        @endslot
                        @slot('button')
                          @yield('page:button')
                        @endslot
                        @yield('page:subtitle')
                        @yield('page:buttons')
                      @endheader
                    @show

                    <!-- content -->
                    @yield('page:content')
                    <!-- content -->

                    @stack('page:footer')
                  @show
                </div>
              </div>
            </div>
          @show
        </main>
        <!-- main -->

        <!-- endnote -->
        @section('app:endnote')
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-0">
                @include('theme::partials.endnote')
              </div>
            </div>
          </div>
        @show
        <!-- endnote -->
      </div>
    @show
  </div>
@stop

@section('footer')
  @include('theme::partials.snackbar')
@endsection
