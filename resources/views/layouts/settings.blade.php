@extends('layouts::admin')

@section('main')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
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
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        @section('page:sidebar')
          @empty (! sidebar()->get('module:setting')->children($setting ?? null))
            <nav class="nav nav-tabs mb-4 mx-0">
              @foreach (sidebar()->get('module:setting')->children($setting ?? null) ?: [] as $menu)
                <div class="nav-item mr-3 {{ $menu->active() ? 'active' : null }}">
                  <a href="{{ $menu->url() }}" class="nav-link  {{ $menu->active() ? 'active' : null }}">
                    {{-- @icon($menu->icon()) --}}
                    @lang($menu->text())
                  </a>
                </div>
              @endforeach
            </nav>
          @endempty
        @show
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        @section('page:content')
          <form action="{{ route('settings.store') }}" method="post">
            @csrf

            @yield('form:content')

            @submit('Save Options')
          </form>
        @show
      </div>
    </div>
  </div>
@stop
