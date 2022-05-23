<section class="text-black ocean-radial cover-financial-report">
  {{-- <div class="ocean">
    <div class="wave"></div>
    <div class="wave"></div>
  </div> --}}

  <div class="waveWrapper waveAnimation">
    <div class="waveWrapperInner bgTop">
      <div class="wave waveTop" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-top.png')"></div>
    </div>
    <div class="waveWrapperInner bgMiddle">
      <div class="wave waveMiddle" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-mid.png')"></div>
    </div>
    <div class="waveWrapperInner bgBottom">
      <div class="wave waveBottom" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-bot.png')"></div>
    </div>
  </div>

  <div class="container" style="position: relative; z-index: 10000;">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-10 col-sm-12">
        <div class="dt-divider" style="height: 50px;"></div>
          {{-- header --}}
          <div class="mb-4 text-center">
            <img height="110" src="{{ theme()->logopath() }}">
          </div>
          <div style="height: 150px;"></div>
          <div class="text-center">
            <h1 class="display-4 dt-BSPI">@lang("SME Ratings")</h1>
            <h1 class="display-4 dt-BSPI">@lang('Financial Analysis Report')</h1>
            @if (isset($data['customer:type']))
              <h2 class="font-weight-normal">({{ __('Based on') }} {{ $data['customer:type'] }} {{ __('Financials') }})</h2>
            @endif
          </div>
          <div style="height: 150px;"></div>
          {{-- header --}}
      </div>
    </div>

    <table width="100%">
      <tr>
        <td valign="top" width="70%">
          <h4 class="mb-3">@lang('Prepared for'):</h4>
          <h2 class="mb-3 mb-0">{{ $data['organisation:profile']['name'] }}</h2>
          @if ($data['month:formatted'] ?? null)
            <div class="mt-5">
              <h4 class="mb-0 font-weight-normal">@lang('Site Visit Date'):</h4>
              <p>{{ $data['month:formatted'] }}</p>
            </div>
          @endif
          {{-- <p class="mb-0">{{ $data['month:formatted'] }}</p> --}}
          @if ($data['customer:counselor'] ?? null)
            <h4 class="mb-0 mt-3">@lang('Business Councelor'):</h4>
            <p class="mb-0">{{ $data['customer:counselor'] }}</p>
          @endif
        </td>
        <td valign="top" width="30%">
          <div>
            <h4 class="mb-0">@lang('Prepared by'):</h4>
            <div style="background: #12263f; height: 1px; margin-top: 40px;"></div>
            <p class="text-center mt-2">{{ $data['report:user'] ?? null }}</p>
          </div>
        </td>
      </tr>
    </table>
    <table width="100%">
      <tr>
        <td valign="top" width="70%">
          <div class="mt-5">
            <cite>
              <small>{{ __('Owned by') }} {{ __('Khalifa Fund for Enterprise Development') }}</small><br />
              <small>{{ __('Powered by') }} {{ settings('app:author') }}</small>
            </cite>
          </div>
        </td>
        <td valign="top" width="70%">
          <div class="mt-5">
            <cite>
              <small class="text-white">Date:</small><br />
              <small>Printed on: {{ $data['month:formatted'] }}</p></small>
            </cite>
          </div>
        </td>
      </tr>
    </table>
  </div>
</section>
