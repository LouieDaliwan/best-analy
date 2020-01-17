@extends('theme::layouts.admin')

@section('page:back') @back @endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <form action="{{ route('customers.update', $resource->id) }}" method="post">
          @csrf
          @method('put')
          @card

            @slot('body')
              {{ field('name')->type('text')->label('Name')->value($resource->name) }}
              {{ field('refnum')->type('text')->label('REF NUM')->value($resource->refnum) }}
              {{ field('code')->type('text')->label('Code')->value($resource->code) }}
              {{-- {{ field('role[]')->label('role') }} --}}
            @endslot
            @slot('footer')
              @submit('Update')
            @endslot
          @endcard
        </form>
      </div>
    </div>
  </div>
@stop
