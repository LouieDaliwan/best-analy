<section
  class="text-black ocean-radial">
  <div class="ocean">
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-10 col-sm-12">
        <div class="dt-divider" style="height: 50px;"></div>
        {{-- header --}}
          <div class="mb-4 text-center">
            <img height="80" src="{{ theme()->logo() }}">
          </div>
          <div class="text-center">
            <h1 class="display-4">@lang("Business Excellence Survey Toolkit (BEST)")</h1>
            <h1 class="display-4">@lang('Overall Report')</h1>
          </div>
        {{-- header --}}

        <div class="text-center">
          <div style="margin-top: 100px; margin-bottom: 100px;">
            <div class="row justify-content-center mb-4">
              <div class="col-md-4 col-sm-12">
                <img style="filter: hue-rotate(158deg) grayscale(0.4);" src="{{ asset('indices/all/png/fm2.png') }}">
              </div>
              <div class="col-md-4 col-sm-12">
                <img src="{{ asset('indices/all/png/bs2.png') }}">
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4 col-sm-12">
                <img style="filter: hue-rotate(50deg)" src="{{ asset('indices/all/png/pm2.png') }}">
              </div>
              <div class="col-md-4 col-sm-12">
                <img style="filter: hue-rotate(201deg) grayscale(0.4);" src="{{ asset('indices/all/png/hr2.png') }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="row justify-content-between">
          <div class="col-md-6 col-sm-12">
            <h4 class="mb-0">@lang('Prepared for'):</h4>
            <h2 class="dt-primary mb-0">{{ $data['organisation:profile']['name'] }}</h2>
            <p class="mb-0">{{ $data['cover:date'] }}</p>
            @if ($data['customer:counselor'] ?? null)
              <h4 class="mb-0 mt-3">@lang('Business Councelor'):</h4>
              <p class="mb-0">{{ $data['customer:counselor'] }}</p>
            @endif

            <div class="mt-5">
              <h4 class="mb-0">@lang('Site Visit Date'):</h4>
              <p>{{ $data['month:formatted'] }}</p>
            </div>

            <div class="mt-5">
              <cite>
                <small>{{ __('Powered by') }} {{ settings('app:author') }}</small>
              </cite>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div>
              <h4 class="mb-0">@lang('Prepared by'):</h4>
              <div style="background: #12263f; height: 1px; margin-top: 40px;"></div>
              <div style="background: #12263f; height: 1px; margin-top: 50px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="height: 250px;"></div>
</section>
