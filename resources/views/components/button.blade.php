<button
  class="btn btn-{{ $class ?? 'primary' }}"
  title="@lang($title ?? $text ?? null)"
  type="{{ $type ?? 'button' }}"
  >
  @isset($prepend) {{ $prepend }} @endisset
  {{ $slot }}
  @isset($append) {{ $append }} @endisset
</button>
