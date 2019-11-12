@extends('layouts::admin')

@section('head:title') @lang('Dashboard') @endsection

@section('page:title') @lang('Dashboard') @endsection

@section('page:header')
  @parent
@endsection

@section('page:content')
  @container(['attr' => 'grid-list-xl'])
    @layout(['attr' => 'row wrap'])
      @flex(['attr' => 'xs12'])

        {{-- @foreach (widgets()->group('dash:topshelf')->all() as $widget)
          @can('widgets.show', $widget['alias'])
            @widget($widget['alias'])
          @endcan
        @endforeach --}}
        {{-- @widget('app:details') --}}
        {{-- @widget('user:count') --}}

        {{-- To be deleted --}}
        @card(['class' => 'mb-3', 'actions' => ['class' => 'grey lighten-3']])
          @slot('title')
            @lang("It's always sunny")
          @endslot
          @slot('body')
            @lang('Lorem ipsum dolor sit amet, consectetur.')
          @endslot
          @slot('footer')
            @button
              @lang('Submit')
            @endbutton
          @endslot
        @endcard

        @back

        @toolbar(['attr' => 'flat', 'class' => 'primary', 'classTitle' => ['class' => 'white--text']])
          @slot('title')
            @lang('All Courses')
          @endslot

          @slot('divider') @endslot

          @slot('button')
            @button(['attr' => 'icon', 'class' => 'transparent white--text'])
              @icon('sort')
            @endbutton
          @endslot
        @endtoolbar

        @card
          @list(['attr' => 'dense', 'url' => route('dashboard'), 'tile' => ['attr' => 'ripple']])
            @slot('avatar')
              @avatar(user()->avatar, ['size' => '30'])
            @endslot

            @slot('action')
              @icon('account', ['size' => '20'])
            @endslot

            @slot('content')
              @slot('title')
                @lang('List Title')
              @endslot
            @endslot
          @endlist
        @endcard
      @endflex
    @endlayout
  @endcontainer
@endsection
