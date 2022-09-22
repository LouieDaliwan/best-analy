{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section class="mt-2">

  <!-- <div class="row">
    <div class="col-md-12">
      <div>
        <h4 class="mb-3 dt-primary text-uppercase">
          @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])
        </h4>
      </div>
    </div>
  </div> -->
  {{-- <section class="overall-indices"> --}}

  <table width="100%" class="mb-5">
    <tr>
      <td valign="top" width="50%">
        <div class="mx-2 mb-3">
          <table width="100%">
            <tr>
              <td class="p-2">
                <h4 class="dt-secondary mb-0">
                  @lang('best::reports.:appcode Score', ['appcode' => __(settings('app:code'))])
                </h4>
              </td>
              <td class="p-2">
                <h4 class="mb-0 dt-secondary text-right">
                {{ $data['overall:percentage'] }}
                </h4>
              </td>
            </tr>
          </table>
          <div class="border-top mb-3"></div>
          <table>
            <tr>
              <td>
                <div>
                  <svg width="180px" height="180px" viewBox="0 0 42 42" class="donut" style="color: {{ $data['overall:result'] }}; background-color: {{ $data['overall:backgroundResult']}}";>
                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>
                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#eeeeee" stroke-width="3"></circle>
                    <circle class="donut-segment" transform="rotate(-90 0 0)
                        translate(-42 0)" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#de9f00" stroke-dasharray="{{ round($data['overall:percentage']) }} {{ 100 - round($data['overall:percentage']) }}" stroke-dashoffset="25" stroke-width="3"></circle>
                    <g class="chart-text">
                      <text x="50%" y="55%" class="chart-number" fill="#de9f00">
                        {{ round($data['overall:percentage']) }}%
                      </text>
                    </g>
                  </svg>
                  {{-- <span class="badge badge-soft-{{ $data['overall:result'] }} font-weight-bold" style="color: {{ $data['overall:result'] }}; background-color: {{ $data['overall:backgroundResult']}}; font-size: 20px;"> --}}
                    {{-- {{ $data['overall:percentage'] }} --}}
                  {{-- </span> --> --}}
                </div>
              </td>
              <td>
                <p class="mb-0">@lang($data['overall:comment'])</p>
              </td>
            </tr>
          </table>
        </div>
      </td>
      <td valign="top" width="50%">
        @include('best::reports.pdf.overall.charts.fmpi')
      </td>
    </tr>
    <tr>
      <td valign="top" width="49%">
        @include('best::reports.pdf.overall.charts.bspi')
      </td>
      <td valign="top" width="49%">
        @include('best::reports.pdf.overall.charts.pmpi')
      </td>
    </tr>
    <tr>
      <td valign="top" width="49%">
        @include('best::reports.pdf.overall.charts.hrpi')
      </td>
      {{-- <td width="2%"></td> --}}
      <td valign="top" width="49%">
        @include('best::reports.pdf.overall.charts.fifth')
      </td>
    </tr>
  </table>

  @include('best::reports.pdf.overall.charts.enablers')
  {{-- </section> --}}
</section>
