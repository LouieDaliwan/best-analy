<div class="card mb-3">
  @isset($title)<div class="card-header">{{ $title }}</div>@endisset
  @isset($body)<div class="card-body">{{ $body }}</div>@endisset
  {{ $slot }}
  @isset($footer)<div class="card-footer">{{ $footer }}</div>@endisset
</div>
