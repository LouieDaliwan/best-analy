<div class="form-group">
  @isset($label) <label for="field-{{ $name }}" class="form-label">{{ trans($label) }}</label> @endisset
  <input
    id="field-{{ $name }}"
    type="{{ $type ?? 'text' }}"
    class="form-control {{ $class ?? null }}"
    name="{{ $name ?? null }}"
    value="{{ old($name ?? null, $value ?? null) }}"
    >
</div>
