<form action="{{ $action ?? null }}" class="form" method="POST">
  @csrf
  @isset($method) @method($method) @endisset
  {{ $slot }}
</form>
