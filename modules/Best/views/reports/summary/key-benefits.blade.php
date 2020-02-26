<section class="section">
  <h1 class="section__title section__title--lead">@lang('Key Benefits')</h1>
  <div class="section__body">
    <ul>
      @foreach (trans('best::reports.benefits') as $key => $benefit)
        <li>@lang("best::reports.benefits.$key")</li>
      @endforeach
    </ul>
  </div>
</section>
