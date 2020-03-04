<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <h1 class="dt-primary">@lang('What\'s in the Report')</h1>
      {{-- Section I --}}
      <h2 class="dt-secondary"><span class="section__badge">@lang('I.')</span> @lang(':appcode Score', ['appcode' => settings('app:code')])</h2>
      <p>@lang('best::reports.Score Description', ['appcode' => settings('app:code')])</p>

      <div class="card">
        <div class="card-body">
          <table class="no-border">
            <tbody>
              <tr class="mb-4">
                <td><span class="badge badge-soft-red mx-2 font-weight-bold" style="color: red;">@lang('RED')</span></td>
                <td><span class="red mdi mdi-circle mr-3"></span></td>
                <td style="color: #ff0000">@lang('Rudimentary efficiency practices in place. Require considerable overhaul and/or introduction of new efficiency process and/or manuals.')</td>
              </tr>
              <tr>
                <td><span class="badge badge-soft-amber mx-2 font-weight-bold">@lang('AMBER')</span></td>
                <td><span class="amber mdi mdi-circle mr-3"></span></td>
                <td style="color: #ffa500">@lang('Generally stable with efficiency elements in place but exists some inconsistencies, needs some streamlining and several introduction of new process and/or manuals. Recommends further consultancy diagnostics.')</td>
              </tr>
              <tr>
                <td><span class="badge badge-soft-success mx-2 font-weight-bold" style="color: #008000;">@lang('GREEN')</span></td>
                <td><span class="green mdi mdi-circle mr-3"></span></td>
                <td style="color: #008000">@lang('Organisation is in good shape. :appcode Elements implemented well with effective forms, processes, policies and structured systems. Recommends microscopic validation.', ['appcode' => settings('app:code')])</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      {{-- Section I --}}

      {{-- Section II --}}
      <h2 class="dt-secondary">@lang('II.') @lang(':appcode Elements', ['appcode' => settings('app:code')])</h2>
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
  </div>
</section>
