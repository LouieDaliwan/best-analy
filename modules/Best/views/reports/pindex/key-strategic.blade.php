<div class="dt-divider" style="height: 50px;"></div>
<section class="strategic">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-3 dt-secondary">@lang('Key Strategic Recommendations')</h1>
        <h4><span style="color:#F48B3C">*</span> Denotes Immediate intervention</h4>
      </div>
    </div>
  </div>

  <div class="row">
    @foreach (collect($data['key:recommendations'])->chunk(2) as $chunk)
      <div class="col-md-6">
        @foreach ($chunk as $key => $recommendation)

          <div class="row four-tec mb-4">
            <div class="col-auto">
              <div class="img{{ $key }} card circular">
                <div class="card-body p-3">
                  <img height="24" src="{{ $recommendation['icon'] }}">
                </div>
              </div>
            </div>
            <div class="col dt-recommendation-title">
              <h2 class="mb-0">@lang($key)</h2>
              @foreach ($recommendation['comments'] as $comment)
                <p class="mb-0">@lang($comment)</p>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>
</section>
