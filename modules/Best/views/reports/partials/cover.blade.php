<section class="text-black" style="#F9FBFD">
  <div class="container fill-height">
    <div class="row">
      <div class="col-md-12">
        <div class="dt-divider" style="height: 50px;"></div>
        {{-- header --}}
        <div class="mb-4 text-center">
          <img height="80" src="{{ theme()->logo() }}">
        </div>
        <div class="text-center">
          <h1 class="display-4">@lang("SME Ratings Report")</h1>
        </div>
        {{-- header --}}
        <div class="dt-divider" style="height: 50px;"></div>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-10 col-sm-12">
            <div class="text-center">
              <div class="mb-3">
                <img height="140" src="{{ $data['pindex:icon'] }}" alt="{{ $data['pindex'] }}"/>
              </div>
              <h1 class="mb-2 dt-{{ $data['pindex:code'] }}">@lang($data['pindex']) @lang('Performance Index') ({{ $data['pindex:code'] }})
              </h1>
              <h1 class="mb-4">@lang('Diagnostic') @lang('Report')</h1>
            </div>
            @foreach ($data['elements:charts']['labels'] as $label)
              <div class="ml-4sds">
                <p>
                  <span style="font-size: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="12px" height="12px"><g><g>
                      <g>
                        <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
                      </g>
                    </g></g> </svg>
                  </span>
                  &nbsp; @lang($label)
                </p>
              </div>
            @endforeach
          </div>
        </div>
        <div class="dt-divider" style="height: 50px;"></div>
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="row justify-content-between">
              <div class="col-md-6 col-sm-12">
                <h4 class="mb-0">@lang('Prepared for'):</h4>
                <h2 class="dt-{{ $data['pindex:code'] }} mb-0">{{ $data['customer:name'] }}</h2>
                <p class="mb-0">{{ $data['cover:date'] }}</p>
                @if ($data['customer:counselor'] ?? null)
                  <h4 class="mb-0 mt-3">@lang('Business Councelor'):</h4>
                  <p class="mb-0">{{ $data['customer:counselor'] }}</p>
                @endif

                <div class="mt-5">
                  <h4 class="mb-0">@lang('Site Visit Date'):</h4>
                  <p>{{ $data['sitevisit:date:formatted'] }}</p>
                </div>

                <div class="mt-5">
                  <cite>
                    <small>{{ __('Owned by') }} {{ __('Khalifa Fund for Enterprise Development') }}</small><br />
                    <small>{{ __('Powered by') }} {{ settings('app:author') }}</small>
                  </cite>
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div>
                  <h4 class="mb-0">@lang('Prepared by'):</h4>
                  <div style="background: #12263f; height: 1px; margin-top: 40px;"></div>
                  <div class="text-center mt-2">{{ $data['report:user'] }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="dt-divider" style="height: 100px;"></div>
</section>
