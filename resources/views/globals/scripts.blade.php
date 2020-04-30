<script>
window.$app = {
  logo: '{{ theme()->logo() }}',
  xlogo: '{{ url('logo.svg') }}',
  locale: '{{ app()->getLocale() }}',
  fallback_locale: '{{ config('app.fallback_locale') }}',
  meta: {!! settings()->containsKey('app') !!},
  language: {!! json_encode(config('language')) !!},
  msauth: {
    clientId: '{{ config('azure-oath.credentials.client_id') }}',
    authority: '{{ config('azure-oath.credentials.authority') }}',
    redirectUri: '{{ url(config('azure-oath.credentials.redirect')) }}',
  },
}
</script>
