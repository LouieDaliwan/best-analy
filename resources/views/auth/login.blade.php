@extends('layouts::auth')

@section('page:content')
  @container
    @layout
      @flex(['attr' => 'col-md-6'])
        @brand
        @form(['action' => url('login')])
          @card
            @slot('title')
              {{ sprintf(trans('Sign in with your %s account'), settings('app:title')) }}
            @endslot
            @slot('body')
              @field('text', [
                'label' => 'Email or Username',
                'name' => 'username',
              ])
              @field('text', [
                'label' => 'Password',
                'name' => 'password',
                'type' => 'password',
                'min' => 6,
              ])
              @field('checkbox', [
                'label' => 'Remember',
                'name' => 'remember',
              ])
              @submit('Login', ['class' => 'primary'])
            @endslot
          @endcard
        @endform
      @endflex

      @flex(['attr' => 'col-md-6'])
        @illustration('login', ['width' => '100%', 'height' => '100%'])
        {{-- @animation('treeswing.gif', [
          'width'=> '500px',
          'height' => '500px'
        ]) --}}
      @endflex
    @endlayout
  @endcontainer
@endsection
