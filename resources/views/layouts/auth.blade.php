@extends('layouts::master')

@section('auth')
  @section('main')
    <main id="main" class="main" data-main>
      @yield('page:header')
      @yield('page:content')
      @yield('page:footer')
    </main>
  @endsection
@show
