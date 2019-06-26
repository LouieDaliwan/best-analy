<button type="button" class="{{ $class ?? 'btn' }} btn-{{ $context ?? 'link' }}" title="{{ $title ?? $text ?? null }}" {{ $attr ?? null }}>
  @isset($icon)<i class="{{ $icon }}"></i>@endisset
  @lang($param ?? null)
</button>
