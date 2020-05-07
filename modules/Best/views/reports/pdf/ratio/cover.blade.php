<section class="text-black ocean-radial">
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
            <img height="80" src="{{ theme()->logopath() }}">
          </div>
          <div style="height: 150px;"></div>
          <div class="text-center">
            <h1 class="display-4 dt-BSPI">@lang("Business Excellence Survey Toolkit (BEST)")</h1>
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
</section>
