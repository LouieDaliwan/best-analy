<script>
window.$app = {
  logo: '{{ url('logo.png') }}',
  locale: '{{ app()->getLocale() }}',
  meta: {!! settings()->containsKey('app') !!},
}
</script>
