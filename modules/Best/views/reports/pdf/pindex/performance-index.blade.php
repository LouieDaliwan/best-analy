{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section class="pindex">
  <div class="row">
    <div class="col-md-12">
      @if($data['pindex:code'] != 'SDMI')
      <h3 style="color: {{ $data['pindex:color'] }};">
        {{ __($data['pindex:code']) }} :
        @lang($data['pindex'])
      </h3>
      @endif
    </div>
  </div>

  @include('best::reports.pdf.pindex.overall-findings')
  @include('best::reports.pdf.pindex.elements-score')
  @include('best::reports.pdf.pindex.key-enablers')
  @include('best::reports.pdf.pindex.key-strategic')
</section>
