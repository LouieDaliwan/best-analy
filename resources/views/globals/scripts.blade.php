<script>
window.$app = {
  logo: '{{ url('logo.png') }}',
  locale: '{{ app()->getLocale() }}',
  fallback_locale: '{{ config('app.fallback_locale') }}',
  meta: {!! settings()->containsKey('app') !!},
  language: {!! json_encode(config('language')) !!},
}
</script>
