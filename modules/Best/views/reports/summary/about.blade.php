<section class="section">
  <h1 class="section__title section__title--lead">@lang('About the Report')</h1>
  <p class="section__body">
    @lang('best::reports.description', [
      'apptitle' => settings('app:fulltitle'),
      'appcode' => settings('app:code'),
      'bspi' => 'xc',
      'pmpi' => 'xc',
      'fmpi' => 'xc',
      'hrpi' => 'xc',
    ])
  </p>
</section>
