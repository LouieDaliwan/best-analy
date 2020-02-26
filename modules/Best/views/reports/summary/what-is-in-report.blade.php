<section class="section">
  <h1 class="section__title section__title--lead">@lang("What's in the Report")</h1>
  <div class="section__body">
    {{-- Section I --}}
    <h3 class="section__title"><span class="section__badge">@lang('I.')</span> @lang(':appcode Score', ['appcode' => settings('app:code')])</h3>
    <p>@lang('best::reports.Score Description', ['appcode' => settings('app:code')])</p>

    <div class="card">
      <div class="card-body">
        <table class="no-border">
          <tbody>
            <tr class="mb-4">
              <td><span class="badge badge-soft-red mx-2 font-weight-bold" style="color: red;">@lang('RED')</span></td>
              <td><div class="traffic-light__light traffic-light__light--red mx-4"></div></td>
              <td style="color: #ff0000">@lang('Rudimentary efficiency practices in place. Require considerable overhaul and/or introduction of new efficiency process and/or manuals.')</td>
            </tr>
            <tr>
              <td><span class="badge badge-soft-amber mx-2 font-weight-bold">@lang('AMBER')</span></td>
              <td><div class="traffic-light__light traffic-light__light--amber mx-4"></div></td>
              <td style="color: #ffa500">@lang('Generally stable with efficiency elements in place but exists some inconsistencies, needs some streamlining and several introduction of new process and/or manuals. Recommends further consultancy diagnostics.')</td>
            </tr>
            <tr>
              <td><span class="badge badge-soft-success mx-2 font-weight-bold" style="color: #008000;">@lang('GREEN')</span></td>
              <td><div class="traffic-light__light traffic-light__light--green mx-4"></div></td>
              <td style="color: #008000">@lang('Organisation is in good shape. :appcode Elements implemented well with effective forms, processes, policies and structured systems. Recommends microscopic validation.', ['appcode' => settings('app:code')])</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    {{-- Section I --}}

    {{-- Section II --}}
    <h3 class="section__title"><span class="section__badge">@lang('II.')</span> @lang(':appcode Elements', ['appcode' => settings('app:code')])</h3>
    <div class="card mb-3">
      <div class="card-body">
        @foreach ($indices ?? $data['indices'] ?? [] as $index)
          <h4 class="font-weight-bold my-0">{{ strtoupper($index['pindex:code']) }} :: {{ $index['pindex'] }}</h4>
          <p>{!! $index['pindex:description'] !!}</p>
        @endforeach
      </div>
    </div>
    {{-- Section II --}}
  </div>
</section>
