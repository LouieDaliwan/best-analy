<script>
window.$app = {
  logo: '{{ url('logo.png') }}',
  meta: {!! settings()->containsKey('app') !!},
}
</script>
