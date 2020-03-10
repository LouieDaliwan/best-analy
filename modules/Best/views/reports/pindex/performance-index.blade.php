<div class="dt-divider" style="height: 50px;"></div>
<section class="pindex">
  <div class="row">
    <div class="col-md-12">
      <h1 style="color: {{ $data['pindex:color'] }};">
        {{ __($data['pindex:code']) }} :
        @lang($data['pindex'])
      </h1>
    </div>
  </div>

  @include('best::reports.pindex.overall-findings')
  @include('best::reports.pindex.elements-score')
  @include('best::reports.pindex.key-enablers')
  @include('best::reports.pindex.key-strategic')
</section>
