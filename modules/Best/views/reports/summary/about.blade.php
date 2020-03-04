<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <h1 class="dt-primary">@lang('About the Report')</h1>
      <p class="mb-0">
        @lang('best::reports.description', [
          'apptitle' => settings('app:fulltitle'),
          'appcode' => settings('app:code'),
          'bspi' => 'xc',
          'pmpi' => 'xc',
          'fmpi' => 'xc',
          'hrpi' => 'xc',
        ])
      </p>
    </div>
  </div>
</section>
