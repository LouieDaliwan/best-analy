<a href="{{ $url ?? null }}" class="{{ $class ?? 'btn btn-link' }}" title="{{ $title ?? $text ?? null }}" {{ $attr ?? null }}>
  @isset($icon)<i class="{{ $icon }}">&nbsp;</i>@endisset
  @lang($param ?? null)
  @isset($append)&nbsp;<i class="small {{ $append }}"></i>@endisset
</a>
