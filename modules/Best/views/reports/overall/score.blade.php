<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-primary text-uppercase">
          @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])
        </h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-2">
      <div class="d-flex justify-content-md-around justify-content-between align-items-center mb-3">
        <div>
          <span class="badge badge-soft-{{ $data['overall:result'] }} font-weight-bold" style="color: {{ $data['overall:result'] }}; background-color: {{ $data['overall:backgroundResult']}}; font-size: 20px;">
            @if($data['overall:percentage'] == 0)
              NO DATA
            @else
              {{ round($data['overall:percentage']) }}
            @endif
        </span>
        </div>
        <div class="overall-label ml-md-4 ml-0">
          @if($data['overall:percentage'] != 0)
            <span class="badge-bg-{{ $data['overall:result'] }}" style="width: 32px; height: 32px; display: inline-block; border-radius: 100%;">
            </span>
          @endif
        </div>
      </div>
    </div>
    <div class="col">
      @if($data['overall:percentage'] != 0)
        <p>@lang($data['overall:comment'])</p>
      @endif
    </div>
  </div>
</section>
