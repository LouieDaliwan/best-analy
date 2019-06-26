<div data-sticky="#page-header"></div>
<header id="page-header" data-sticky-class="bg-workspace sticky" class="d-block page-header mb-3">
  @yield('page:back')
  <div class="d-flex align-items-center justify-content-between">
    <h1 class="page-title">{{ $title }}</h1>
    @isset($button)<div>{{ $button }}</div>@endisset
  </div>
  {{ $slot }}
</header>
