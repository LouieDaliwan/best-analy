<button type="submit" class="{{ $class ?? 'btn' }} btn-{{ $context ?? 'primary' }}">
  @isset ($icon)
    @icon($icon)
  @endisset
  @lang($param ?? 'Submit')
</button>
