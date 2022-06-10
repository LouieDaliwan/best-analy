{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section>
  <div class="row">
    <div class="col-md-12">
      <p class="dt-primary mb-1 font-weight-bold">@lang('What\'s in the Report')</p>
      {{-- Section I --}}
      <p class="dt-secondary">@lang('I.') @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])</p>
      <p>@lang('best::reports.Score Description', ['appcode' => __(settings('app:code'))])</p>

      {{-- <table>
        <tr>
          <td valign="middle"><span class="badge badge-soft-red font-weight-bold mr-2" style="color: red;">@lang('RED')</span></td>
          <td><span class="badge-bg-red mr-2" style="margin-left: 16px; width: 16px; height: 16px; display: inline-block; border-radius: 100%;">
          </span></td>
          <td><span class="red mr-2">@lang('Rudimentary efficiency practices in place. Require considerable overhaul and/or introduction of new efficiency process and/or manuals.')</span></td>
        </tr>
      </table>

      <table>
        <tr>
          <td valign="middle"><span class="badge badge-soft-amber font-weight-bold mr-2" style="color: amber;">@lang('AMBER')</span></td>
          <td><span class="badge-bg-amber mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;">
          </span></td>
          <td><span class="amber mr-2">@lang('Generally stable with efficiency elements in place but exists some inconsistencies, needs some streamlining and several introduction of new process and/or manuals. Recommends further consultancy diagnostics.')</span></td>
        </tr>
      </table>

      <table>
        <tr>
          <td valign="middle"><span class="badge badge-soft-green font-weight-bold mr-2" style="color: green;">@lang('GREEN')</span></td>
          <td><span class="badge-bg-green mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;">
          </span></td>
          <td><span class="green mr-2">@lang('Organisation is in good shape. :appcode Elements implemented well with effective forms, processes, policies and structured systems. Recommends microscopic validation.', ['appcode' => settings('app:code')])</span></td>
        </tr>
      </table> --}}

      <table width="100%" class="mb-3">
        <tr valign="middle">
          <td width="25%" valign="middle" style="text-align: center;">
            <span class="badge-bg-red mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
            <span style="color: red;">@lang('Failed')</span>
          </td>
          <td width="25%" valign="middle" style="text-align: center;">
            <span class="badge-bg-amber mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
            <span style="color: amber;">@lang('Critical')</span>
          </td>
          <td width="25%" valign="middle" style="text-align: center;">
            <span class="badge-bg-green mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%;"></span>
            <span style="color: green;">@lang('Corrective Action')</span>
          </td>
          <td width="25%" valign="middle" style="text-align: center;">
            <span class="mr-2" style="width: 16px; height: 16px; display: inline-block; border-radius: 100%; background-color: black;"></span>
            <span >@lang('Corrective Action')</span>
          </td>
        </tr>
      </table>
      {{-- Section I --}}

      {{-- Section II --}}
      <p class="dt-secondary">@lang('II.') @lang('best::elements.:appcode Elements', ['appcode' => settings('app:code')])</p>
      @foreach ($indices ?? $data['indices'] ?? [] as $index)
        <h4 class="mb-3">{{ strtoupper($index['pindex:code']) }} : {{ __($index['pindex']) }}</h4>
        @foreach (trans("best::indices/descriptions.{$index['pindex:code']}") ?? [] as $desc)
          <p>- {{ $desc }}</p>
        @endforeach
      @endforeach
      {{-- Section II --}}
    </div>
  </div>
</section>
