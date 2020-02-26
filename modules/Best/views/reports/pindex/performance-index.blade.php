<section class="section">
  <h1 class="section__title section__title--lead">
    {{ __($data['pindex:code']) }} :: {{ __($data['pindex']) }}
  </h1>

  @include('best::reports.pindex.overall-findings')
  @include('best::reports.pindex.elements-score')
  @include('best::reports.pindex.key-enablers')
  @include('best::reports.pindex.key-strategic')
</section>
