@extends('theme::layouts::admin')

@section('page')
  <form action="{{ route('customers.store') }}" method="POST" autocomplete="off">

    @csrf

    @header
      @slot('title')@lang('Add Customers')@endslot
      @slot('button')
        @submit('Save', ['icon' => 'mdi mdi-content-save'])
      @endslot
    @endheader

    <div class="card mb-3">
      <div class="card-header">{{ __('Personal Information') }}</div>
      <div class="card-body">
        <div class="row-wrap">
          <div class="col-md-4">
            {{ field('name')->type('text')->label('Name')->autofocus() }}
          </div>
          <div class="col-md-4">
            {{ field('refnum')->type('text')->label('Reference Number') }}
          </div>
          <div class="col-md-4">
            {{ field('code')->type('text')->label('Code') }}
          </div>
        </div>
      </div>
    </div>

  </form>
@endsection
