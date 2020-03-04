<div class="dt-divider" style="height: 50px;"></div>
<section class="strategic">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-secondary">@lang('KEY STRATEGIC RECOMMENDATIONS')</h1>
      </div>
    </div>
  </div>

  <div class="row">
    @foreach (collect($data['key:recommendations'])->chunk(2) as $chunk)
      <div class="col-md-6">
        @foreach ($chunk as $key => $recommendation)
          <h4 class="mb-4">@lang($key)</h4>
          <div class="row four-tec">
            <div class="col-auto">
              <div class="img{{ $key }} card">
                <div class="card-body">
                  <img height="48" src="{{ $recommendation['icon'] }}">
                </div>
              </div>
            </div>
            <div class="col">
              <p class="mb-0">@lang($recommendation['comment'])</p>
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>
</section>
