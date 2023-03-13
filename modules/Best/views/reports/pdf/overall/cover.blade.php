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
            <img height="120" src="{{ theme()->logopath() }}">
          </div>
          <div class="text-center">
            {{-- <h1 class="display-4">@lang(settings('app:fulltitle'))</h1> --}}
            <h1 class="display-4">@lang("SME Ratings Report")</h1>
          </div>
        {{-- header --}}
        <div class="text-center">
          <div style="margin-top: 100px; margin-bottom: 100px;">
            <table width="100%">
              <tr>
                <td align="center">
                  <img width="100%" src="{{ public_path('indices/all/cover-image.png') }}">
                </td>
              </tr>
            </table>
          </div>
        </div>
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
          <div class="mt-5"
            @if (app()->getLocale() == 'ar')
              style="text-align: left !important;"
            @endif
            >
            <cite>
              <small class="text-white">Date:</small><br />
              <small>{{ __('Report Printed On') }}: <?php echo date("M d, Y"); ?></p></small>
            </cite>
          </div>
        </td>
      </tr>
    </table>
  </div>
  {{-- <div style="height: 250px;"></div> --}}
</section>
