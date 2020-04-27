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
            <img height="80" src="{{ theme()->logopath() }}">
          </div>
          <div class="text-center">
            <h1 class="display-4">@lang("Business Excellence Survey Toolkit (BEST)")</h1>
            <h1 class="display-4">@lang('Overall Report')</h1>
          </div>
        {{-- header --}}

        <div class="text-center">
          <div style="margin-top: 100px; margin-bottom: 100px;">

            <table width="100%">
              <tr>
                <td align="center"><img style="filter: hue-rotate(158deg) grayscale(0.4);" src="{{ public_path('indices/all/hue/fm2.png') }}"></td>
                <td align="center"><img src="{{ public_path('indices/all/hue/bs2.png') }}"></td>
              </tr>
              <tr>
                <td align="center"><img style="filter: hue-rotate(50deg)" src="{{ public_path('indices/all/hue/pm2.png') }}"></td>
                <td align="center"><img style="filter: hue-rotate(201deg) grayscale(0.4);" src="{{ public_path('indices/all/hue/hr2.png') }}"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <table width="100%">
      <tr>
        <td valign="top">
          <h4 class="mb-3">@lang('Prepared for'):</h4>
          <h2 class="mb-3 mb-0">{{ $data['organisation:profile']['name'] }}</h2>
          <p class="mb-0">{{ $data['cover:date'] }}</p>
          @if ($data['customer:counselor'] ?? null)
            <h4 class="mb-0 mt-3">@lang('Business Councelor'):</h4>
            <p class="mb-0">{{ $data['customer:counselor'] }}</p>
          @endif

          @if ($data['month:formatted'] ?? null)
            <div class="mt-5">
              <h4 class="mb-0">@lang('Site Visit Date'):</h4>
              <p>{{ $data['month:formatted'] }}</p>
            </div>
          @endif

          <div class="mt-5">
            <cite>
              <small>{{ __('Powered by') }} {{ settings('app:author') }}</small>
            </cite>
          </div>
        </td>
        <td valign="top">
          <div>
            <h4 class="mb-0">@lang('Prepared by'):</h4>
            <div style="background: #12263f; height: 1px; margin-top: 40px;"></div>
            <div class="text-center mt-2">{{ $data['report:user'] ?? null }}</div>
          </div>
        </td>
      </tr>
    </table>
  </div>
  {{-- <div style="height: 250px;"></div> --}}
</section>
