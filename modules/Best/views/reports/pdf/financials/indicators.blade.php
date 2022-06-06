{{-- <div style="zoom: 0.76; line-height: 1;"> --}}
<div style="line-height: 1.3;">
  <section class="mt-3">
    <table width="100%">
      <tbody>
        <tr>
          <td class="p-3" width="40%">
            <h1 class="dt-primary " style="border">@lang('Productivity Analysis')</h1>
            <hr>
          </td>
          <td class="p-3" width="50%">
            <h1 class="dt-primary">@lang('VA Indicators')</h1>
            <hr>
          </td>
        </tr>
        <tr>
          <td valign="middle" width="50%" class="p-3" >
            <div valign="middle" class="mt-3">
              <div class="py-5">
                <div class="chart-analysis">
                  <div class="mr-3" style="margin: auto; zoom: 0.80;">
                    <canvas id="productivityIndicators" width="550" height="200" style="margin: auto;"></canvas>
                  </div>
                  {{-- <div class="mr-3" style="width: 700px; height: 200px;">
                    <canvas id="productivityIndicators" style="width: 700px; height: 200px;"></canvas>
                  </div> --}}
                </div>
                {{-- label --}}
                <div style="height: 20px;"></div>
                <table class="indiLabels" width="50%" align="center">
                  <tr>
                    @foreach ($data['analysis:financial']['productivity']['charts']['dataset'] as $resource)
                      <td>
                        <span class="circular p-2" style="background: {{ $resource['bg'] }};"></span>
                        &nbsp;
                        <span>{{ $resource['label'] }}</span>
                      </td>
                    @endforeach
                  </tr>
                </table>
              </div>
            {{-- label --}}
              <div class="col-md-12 mt-3 comment-analysis">
                @foreach ($data['analysis:financial']['productivity']['comments'] as $comments)
                  <div class="row">
                    <div class="col px-5">
                      @foreach ($comments as $comment)
                        <p class="mb-1">{{ $comment }}</p>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </td>
          <td valign="top" width="50%" class="p-3" >
            <table class="table table-indicator-main">
              <tbody>
                @foreach ($data['indicators:productivity'] as $key => $d)
                  <tr class="title table-indicator">
                    <td colspan="5">{{ __($key) }}</td>
                  </tr>
                  @foreach ($d as $i => $vs)
                    @if($key == 'summary')
                      <tr class="ratio{{ $key }}-{{ $i }}">
                        @php
                        $l = 0;
                        @endphp
                        @foreach ($vs as $j => $v)
                            <td class="{{ empty($v) ? "empty-$l" : null }} {{ $key }}-{{ $i }}">{{ __($v) }}</td>
                        @endforeach
                      </tr>
                    @endif
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          @include('best::reports.pdf.financials.indicators.list')
        </tr>
      </tbody>
    </table>
  </section>
</div>

<style>
/*  .indiLabels tr td {
     padding-left: 25%;
     text-align: center;
     width:  100%;
  }*/

  td[colspan=3], td.colspan-text, .colspan-text {
    border-right: 1px solid #868e96 !important;
  }
  .empty-1:empty {
    display: none;
  }
  .table td, .table th {
    border-top: none;
  }
</style>

<script>
$(document).ready(function() {
    var ctx = document.getElementById("productivityIndicators").getContext('2d');
    var dataset = {!! json_encode($data['analysis:financial']['productivity']['charts']['dataset']) !!}
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode(collect(
          $data['analysis:financial']['productivity']['charts']['labels'])->values()->toArray()
        ) !!},
        datasets: dataset,
      },
      options: {
        animation: {
          duration: 1,
          onComplete: function () {
              var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';

              this.data.datasets.forEach(function (dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function (bar, index) {
                      var data = dataset.data[index] + '%';
                      ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
              });
          }
        },
        legend: false,
        scales: {
          xAxes: [{
            barPercentage: 0.2,
            gridLines: {
              display: false,
            },
            ticks: {
              beginAtZero: true,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            barPercentage: 0.1,
            gridLines: {
              display: false,
            },
            ticks: {
              beginAtZero: true,
              maxTicksLimit: 5,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
              callback: function(value){return value}
            }
          }]
        }
      },
    });
  });
</script>
