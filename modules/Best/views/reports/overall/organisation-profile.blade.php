<div class="dt-divider block" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-6 col-sm-12">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <h4 class="mb-1">@lang('Organisation Name') :</h4>
        </div>
        <div class="col">
          <p class="mb-1">{{ __($data['organisation:profile']['name']) }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <h4 class="mb-1">@lang('File Number') :</h4>
        </div>
        <div class="col">
          <p class="mb-1">{{ __($data['organisation:profile']['refnum']) }}</p>
        </div>
      </div>
    </div>
  </div>
</section>
