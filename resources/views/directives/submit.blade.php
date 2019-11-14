<button
  class="btn btn-{{ $class ?? 'primary' }}"
  title="@lang($title ?? $text ?? null)"
  type="submit"
  >
  @isset($prepend) {{ $prepend }} @endisset
  @lang($param ?? 'Submit')
  @isset($append) {{ $append }} @endisset
</button>
