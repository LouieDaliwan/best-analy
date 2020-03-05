{{-- <section class="text-black" style="background-color: #8EC5FC; background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%) !important;"> --}}
<section class="text-black" style="#F9FBFD">
  <div class="dt-divider" style="height: 100px;"></div>
    <div class="container fill-height">
      <div class="row">
        <div class="col-md-12">

        {{-- header --}}
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex align-items-center justify-content-center">
                <div class="mr-3"><img height="60" src="{{ asset('logo.svg') }}"></div>
                <div>
                  <h1 class="mb-2 text-uppercase">Business Excellence Survey Test (BEST) Report</h1>
                  <div>@lang('Empowered by') {{ settings('app:author') }}</div>
                </div>
              </div>
            </div>
          </div>
          {{-- header --}}

          <div class="dt-divider" style="height: 50px;"></div>

          <div class="row align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12">
              <div class="text-center">
                <h1 class="dt-secondary">{{ __('Business Excellence Survey Toolkit') }} &nbsp; ({{ __('BEST') }})</h1>
                <h2 class="mb-4 dt-secondary">{{ trans('Dashboard Report') }}</h2>
                <div class="row my-5">
                  <div class="col-md-6 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                          <div class="col-auto">
                            <img height="80" src="{{ asset('indices/all/png/fm2.png') }}"/>
                          </div>
                          <div class="col"><h2>FINANCIAL <br> Management</h2></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                          <div class="col-auto">
                            <img height="80" src="{{ asset('indices/all/png/bs2.png') }}"/>
                          </div>
                          <div class="col"><h2>BUSINESS <br> Sustainability</h2></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                          <div class="col-auto">
                            <img height="80" src="{{ asset('indices/all/png/pm2.png') }}"/>
                          </div>
                          <div class="col"><h2>PRODUCTIVITY <br> Management</h2></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                          <div class="col-auto">
                            <img height="80" src="{{ asset('indices/all/png/hr2.png') }}"/>
                          </div>
                          <div class="col"><h2>HUMAN <br> Resource</h2></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="dt-divider" style="height: 50px;"></div>
          <div class="row justify-content-center">
            <div class="col-md-10">
              <p class="mb-0"><strong>{{ __('Prepared for:') }}</strong></p>
              <h2 class="dt-primary mb-0">{{ $data['organisation:profile']['name'] }}</h2>
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
