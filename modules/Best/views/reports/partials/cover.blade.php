{{-- <section class="text-black" style="background-color: #8EC5FC; background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%) !important;"> --}}
<section class="text-black" style="#F9FBFD">
  <div class="dt-divider" style="height: 100px;"></div>
    <div class="container fill-height">
      <div class="row">
        <div class="col-md-12">

          {{-- header --}}
          <div class="d-flex justify-content-center align-items-center">
            <div class="row justify-content-center align-items-center">
              <div class="col-md-auto col-sm-12">
                <div class="mb-md-0 mb-3 mr-3"><img height="60" src="{{ asset('logo.svg') }}"></div>
              </div>
              <div class="col">
                <h1 class="mb-2 text-uppercase">Business Excellence Survey Test (BEST) Report</h1>
                <div>@lang('Empowered by') {{ settings('app:author') }}</div>
              </div>
            </div>
          </div>
          {{-- header --}}

          <div class="dt-divider" style="height: 50px;"></div>
          <div class="row align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12">
              <div class="text-center">
                <div class="mb-3">
                  <img height="140" src="{{ $data['pindex:icon'] }}" alt="{{ $data['pindex'] }}"/>
                </div>
                <h1>{{ $data['pindex'] }} {{ trans('Performance Index') }} ({{ $data['pindex:code'] }})
                </h1>
                <h2 class="mb-4">{{ trans('Diagnostic Report') }}</h2>
              </div>
              {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus nisi modi, totam itaque omnis vitae odit quasi ex alias obcaecati aliquid sint in facere dolor, ipsum incidunt explicabo ab maxime.</p> --}}
              {{-- <p>@lang('best::reports/cover.{name}', ['name' => $data['pindex:code']])</p> --}}
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
              <p class="mb-0"><strong>{{ __('Prepared for:') }}</strong></p>
              <h2 class="dt-primary mb-0">{{ $data['customer:name'] }}</h2>
              <p class="mb-0">{{ $data['cover:date'] }}</p>
              <div class="mt-5">
                <cite>
                  <small class="text-muted">{{ __('Empowered by') }} {{ settings('app:author') }}</small>
                </cite>
              </div>
            </div>
          </div>
      </div>
    </div>
  <div class="dt-divider" style="height: 100px;"></div>
</section>
