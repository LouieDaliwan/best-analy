<div class="page-heading">
  <div class="heading">{{ settings('app:fulltitle') }} @lang('Toolkit Report')div>
  <div class="subheading">@lang('Empowered by') {{ settings('app:author') }}</div>
</div>

<section class="section">
  <h1 class="section__title section__title--lead">@lang('About the Report')</h1>
  <div class="section__body">
    @lang('best::reports.description', [
      'apptitle' => settings('app:fulltitle'),
      'appcode' => settings('app:code'),
      'bspi' => 'xc',
      'pmpi' => 'xc',
      'fmpi' => 'xc',
      'hrpi' => 'xc',
    ])
  </div>
</section>

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

<section class="section">
  <h1 class="section__title section__title--lead">@lang("What's in the Report")</h1>
  <div class="section__body">
    {{-- Section I --}}
    <h3 class="section__title"><span class="section__badge">@lang('I.')</span> <strong>@lang(':appcode Score', ['appcode' => settings('app:code')])</strong></h3>
    <p>@lang('best::reports.Score Description', ['appcode' => settings('app:code')])</p>

    <table class="traffic-light">
      <tbody>
        <tr>
          <td>@lang('RED')</td>
          <td><div class="traffic-light__light traffic-light__light--red"></div></td>
          <td style="color: red">@lang('Rudimentary efficiency practices in place. Require considerable overhaul and/or introduction of new efficiency process and/or manuals.')</td>
        </tr>
        <tr>
          <td>@lang('AMBER')</td>
          <td><div class="traffic-light__light traffic-light__light--amber"></div></td>
          <td style="color: #77660b">@lang('Generally stable with efficiency elements in place but exists some inconsistencies, needs some streamlining and several introduction of new process and/or manuals. Recommends further consultancy diagnostics.')</td>
        </tr>
        <tr>
          <td>@lang('GREEN')</td>
          <td><div class="traffic-light__light traffic-light__light--green"></div></td>
          <td style="color: green">@lang('Organisation is in good shape. :appcode Elements implemented well with effective forms, processes, policies and structured systems. Recommends microscopic validation.', ['appcode' => settings('app:code')])</td>
        </tr>
      </tbody>
    </table>
    {{-- Section I --}}

    {{-- Section II --}}
    <h3 class="section__title"><span class="section__badge">@lang('II.')</span> <strong>@lang(':appcode Elements', ['appcode' => settings('app:code')])</strong></h3>
    @foreach ($indices ?? [] as $index)
      <h3>{{ strtoupper($index->code) }} :: {{ $index->name }}</h3>
      <div>{!! $index->description !!}</div>
    @endforeach
    {{-- Section II --}}
  </div>
</section>

<section class="section">
  <h1 class="section__title section__title--lead">@lang('Data Reliability & Validity')</h1>
  <div class="section__body">
    <p>@lang('It is important that the understanding, perception and observation of an organisation cannot be relied upon from an individual only. A collective observation from multiple individuals is critical to ensure that a better understanding of an organisation is achieved.')</p>
    <p>@lang('Hence, to ensure that we have collected sufficient inputs from various individuals in the organisation, a minimum sample size of 5 to 10% of the total organisation staff strength is RECOMMENDED to complete the series of questionnaire to ensure the reliability of the report is not compromised.')</p>
  </div>
</section>

<section class="section">
  <h1 class="section__title section__title--lead">@lang('Data Privacy')</h1>
  <div class="section__body">
    <p>@lang('By sharing company information, the Client has consented SSA Consulting Pte Ltd and its appointed technology vendor (collectively now called "the Consultant") to have access to the information. All data shared by the Client will be treated as strictly confidential and not disclosed to any non-involving third party. The Confidential Information shall be used for the sole purpose of performing the Consultant’s obligations and shall not be used for any other purposes. The Consultant shall take all reasonable precautions in dealing with Confidential Information so as to prevent any unauthorised person from having access to such Confidential Information. The Consultant shall not publish or release, nor shall it allow or suffer the publication or release of, any news item, article, publication, advertisement, prepared speech or any other information or material making reference to the Client. This applies to matters pertaining to any part of the obligations to be performed by the Consultant in any media without the prior written consent of the Client.')</p>
  </div>
</section>
