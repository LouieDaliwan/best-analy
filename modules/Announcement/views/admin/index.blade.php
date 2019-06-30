@extends('layouts::admin')

@section('page:content')
  @tablecard(['class' => 'table-borderless'])
    @slot('header')
      @searchform
      @pagedropdown
    @endslot

    @if ($resources->isEmpty())
      @svg('theme::icons.deactivate')
      <p class="text-muted text-center mb-4">
        @lang('No resource found.')
      </p>
    @endif

    @if ($resources->isNotEmpty())

    @endif
  @endtablecard
@endsection
