<section class="section">
  <h1 class="section__title section__title--lead">@lang('Report Objectives')</h1>
  <div class="section__body">
    <ul>
      @foreach (trans('best::reports.objectives') as $key => $objective)
        <li>@lang("best::reports.objectives.$key", ['appcode' => settings('app:code')])</li>
      @endforeach
    </ul>
  </div>
</section>
