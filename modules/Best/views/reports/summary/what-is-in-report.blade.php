<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <h1 class="dt-primary">@lang('What\'s in the Report')</h1>
      {{-- Section I --}}
      <h2 class="dt-secondary">@lang('I.') @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])</h2>
      <p>@lang('best::reports.Score Description', ['appcode' => __(settings('app:code'))])</p>

      <div class="card text-center">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 col-12">
              <span class="badge-bg-red mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
              <span style="color: red;">@lang('Failed')</span>
            </div>
            <div class="col-md-3 col-12">
              <span class="badge-bg-amber mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
              <span style="color: amber;">@lang('Critical')</span>
            </div>
            <div class="col-md-3 col-12">
              <span class="badge-bg-green mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
              <span style="color: green;">@lang('Corrective Action')</span>
            </div>
            <div class="col-md-3 col-12">
              <span class="mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%; background-color: black;"></span>
              <span >@lang('Normal')</span>
            </div>
          </div>

          {{-- <div class="row">
            <div class="col-sm-12 col-md-2">
              <div class="d-flex justify-content-between mb-3">
                <div><span class="badge badge-soft-red font-weight-bold" style="color: red;">@lang('RED')</span></div>
                <div><span class="red mdi mdi-circle ml-4"></span></div>
              </div>
            </div>
            <div class="col">
              <p class="red">@lang('Rudimentary efficiency practices in place. Require considerable overhaul and/or introduction of new efficiency process and/or manuals.')</p>
            </div>
          </div> --}}

        </div>
      </div>
      {{-- Section I --}}

      {{-- Section II --}}
      <h2 class="dt-secondary">@lang('II.') @lang('best::elements.:appcode Elements', ['appcode' => settings('app:code')])</h2>
      <div class="card mb-3">
        <div class="card-body">
          @foreach ($indices ?? $data['indices'] ?? [] as $key => $index)
            <h4 class="mb-3">{{ strtoupper($index['pindex:code']) }} : {{ __($index['pindex']) }}</h4>
            @foreach (trans("best::indices/descriptions.{$index['pindex:code']}") ?? [] as $desc)
              <p>- {{ $desc }}</p>
            @endforeach
        @endforeach
        </div>
      </div>
      {{-- Section II --}}
    </div>
  </div>
</section>
