@extends('layouts::auth')

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">

        @include('theme::partials.brand')

        <form class="card mb-3" action="{{ url('login') }}" method="POST">
          @csrf
          <div class="card-header">
            <strong>{{ sprintf(__('Sign in with your %s account'), settings('site_title')) }}</strong>
          </div>
          <div class="card-body">

            {{ field('username')->type('text')->label('User name')->autofocus() }}

            {{ field('password')->type('password')->label('Password') }}

            {{ field('remember')->type('checkbox')->label('Remember me')->tabindex(-1)->checked(1)->value(1) }}

            {{ field()->type('submit')->text('Sign in') }}

          </div>
          <div class="card-footer">
            @settings('registration:enabled', true)
              <p class="text-left text-muted">{{ __("Don't have account yet?") }} <a href="{{ route('register') }}">{{ __('Sign up') }}.</a></p>
            @endsettings
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
