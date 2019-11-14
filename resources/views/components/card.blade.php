<div class="card {{ $class ?? null }}" {{ $attr ?? null }}>
  @isset($title)
    <div class="card-header">
      <h2 class="card-title font-weight-bold mb-0">{{ $title }}</h2>
    </div>
  @endisset

  @isset($body)<div class="card-body">{{ $body }}</div>@endisset

  @isset($footer)
    <div class="{{ $actions['class'] ?? null }}">
      {{ $footer }}
    </div>
  @endisset
</div>
