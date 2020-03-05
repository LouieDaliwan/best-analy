<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-primary text-uppercase">@lang('BEST SCORE')</h1>
      </div>
    </div>
  </div>

  <div class="row align-items-center justify-content-center">
    <div class="col-md-2">
      <div class="mb-3">
        <div class="d-flex align-items-center">
          <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 20px;">
            {{ $data['overall:percentage'] }}
          </span>
          <div class="overall-label mx-4">
            <span class="badge-bg-{{ $data['overall:result'] }}" style="width: 32px; height: 32px; display: inline-block; border-radius: 100%;"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <p>@lang($data['overall:comment'])</p>
    </div>
  </div>
</section>
