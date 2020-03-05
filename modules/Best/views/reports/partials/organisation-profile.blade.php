<div class="dt-divider block" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-6 col-sm-12">
      <div class="row">
        <div class="col-md-5 col-sm-12">
          <p><strong>@lang('Organisation Name') :</strong></p>
        </div>
        <div class="col">
          <p>{{ __($data['organisation:profile']['name']) }}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5 col-sm-12">
          <p><strong>@lang('File Number') :</strong></p>
        </div>
        <div class="col">
          <p>{{ __($data['organisation:profile']['refnum']) }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
      <div class="row">
        <div class="col-md-5 col-sm-12">
          <p><strong>@lang('Industry') :</strong></p>
        </div>
        <div class="col">
          <p>{{ __($data['organisation:profile']['metadata']['industry']) }}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5 col-sm-12">
          <p><strong>@lang('Staff Strength') :</strong></p>
        </div>
        <div class="col">
          <p>{{ __($data['organisation:profile']['metadata']['staffstrength']) }}</p>
        </div>
      </div>
    </div>
  </div>
</section>
