<section class="my-2">
  <h3 class="dt-BSPI">{{ __('Overall Comments') }}</h3>

  {{-- box --}}
  <div style="border: 1px solid #333333; width: 100%; height: 500px;">
    <p class="p-3">
      {!! nl2br($data['overall:user:comment'] ?? null) !!}
    </p>
  </div>
  {{-- box --}}

  <div style="height: 100px;"></div>

  <div class="row">
    <div class="col-sm-4">
      <div style="border: 1px solid #12263f; height: 40px;"></div>
      <div class="text-center mt-3">{{ __('Client Signature') }}</div>
    </div>

    <div class="col-sm-4">
      <div style="border: 1px solid #12263f; height: 40px;"></div>
      <div class="text-center mt-3">{{ __('Manager Signature') }}</div>
    </div>

    <div class="col-sm-4">
      <div style="border: 1px solid #12263f; height: 40px;"></div>
      <div class="text-center mt-3">{{ __('Business Counselor Signature') }}</div>
    </div>
  </div>
</section>
