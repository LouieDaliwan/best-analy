@switch(request()->get('order'))
  @case('asc')
    <a href="{{ __url(['sort' => $key, 'order' => 'desc']) }}">{{ __($label ?? 'Label') }}&nbsp;<i class="mdi mdi-sort-descending"></i></a>
    @break

  @case('desc')
    <a href="{{ __url(['sort' => null, 'order' => null]) }}">{{ __($label ?? 'Label') }}&nbsp;<i class="mdi mdi-sort-ascending"></i></a>
    @break

  @default
    <a href="{{ __url(['sort' => $key, 'order' => 'asc']) }}">{{ __($label ?? 'Label') }}</a>
@endswitch

