<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <h1 class="dt-primary">@lang('About the Report')</h1>
      <p class="mb-0">
        @lang('best::reports.description', [
          'apptitle' => __(settings('app:fulltitle')),
          'appcode' => __(settings('app:code')),
          'bspi' => __('Business Sustainability'),
          'pmpi' => __('Productivity Management'),
          'fmpi' => __('Financial Management'),
          'hrpi' => __('Human Resource'),
        ])
      </p>
    </div>
  </div>
</section>
