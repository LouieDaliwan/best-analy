<section class="table-ratio">
  <div class="row">
    <div class="col-md-6 col-sm-12">
      @include('best::reports.table.sheet.ratios', ['data' => $data['ratios:financial']])
    </div>
    <div class="col-md-6 col-sm-12">
      @include('best::reports.table.sheet.indicators', ['data' => $data['indicators:productivity']])
    </div>
  </div>
</section>
