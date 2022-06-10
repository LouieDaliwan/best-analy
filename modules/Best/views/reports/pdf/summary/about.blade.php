{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <p class="dt-primary mb-1 font-weight-bold">@lang('About the Report')</p>
      <p class="mb-0">
        @lang('best::reports.description', [
          'apptitle' => __(settings('app:fulltitle')),
          'appcode' => __(settings('app:code')),
          'bspi' => __('Business Sustainability'),
          'pmpi' => __('Productivity Management'),
          'fmpi' => __('Financial Management'),
          'hrpi' => __('Human Resource'),
          'sdmi' => __('Strategy Development & Management'),
        ])
      </p>
    </div>
  </div>
</section>
