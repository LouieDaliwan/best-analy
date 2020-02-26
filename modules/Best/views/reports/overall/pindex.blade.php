<table class="table" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td valign="top" class="half-width-table">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="100%" valign="top">
            <h1 class="section__title section__subtitle--lead" style="position: relative;">
              @lang($data['indices']['FMPI']['pindex'])
              <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 10px; position: absolute; right: 0; padding: 2px; margin-top: -1px !important;">
                {{ $data['indices']['FMPI']['overall:total'] }}
              </span>
            </h1>
            <table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td>
                  @include('best::reports.overall.charts.fmpi')
                </td>
              </tr>
              <tr>
                <td align="center">
                  <p>@lang($data['indices']['FMPI']['overall:comment'])</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td valign="top" class="half-width-table">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="100%" valign="top">
            <h1 class="section__title section__subtitle--lead" style="position: relative;">
              @lang($data['indices']['BSPI']['pindex'])
              <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 10px; position: absolute; right: 0; padding: 2px; margin-top: -1px !important;">
                {{ $data['indices']['BSPI']['overall:total'] }}
              </span>
            </h1>
            <table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td>
                  @include('best::reports.overall.charts.bspi')
                </td>
              </tr>
              <tr>
                <td align="center">
                  <p>@lang($data['indices']['BSPI']['overall:comment'])</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td valign="top" class="half-width-table">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="100%" valign="top">
            <h1 class="section__title section__subtitle--lead" style="position: relative;">
              @lang($data['indices']['PMPI']['pindex'])
              <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 10px; position: absolute; right: 0; padding: 2px; margin-top: -1px !important;">
                {{ $data['indices']['PMPI']['overall:total'] }}
              </span>
            </h1>
            <table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td>
                  @include('best::reports.overall.charts.pmpi')
                </td>
              </tr>
              <tr>
                <td align="center">
                  <p>@lang($data['indices']['PMPI']['overall:comment'])</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td valign="top" class="half-width-table">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="100%" valign="top">
            <h1 class="section__title section__subtitle--lead" style="position: relative;">
              @lang($data['indices']['HRPI']['pindex'])
              <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 10px; position: absolute; right: 0; padding: 2px; margin-top: -1px !important;">
                {{ $data['indices']['HRPI']['overall:total'] }}
              </span>
            </h1>
            <table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td>
                  @include('best::reports.overall.charts.hrpi')
                </td>
              </tr>
              <tr>
                <td align="center">
                  <p>@lang($data['indices']['HRPI']['overall:comment'])</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table>
