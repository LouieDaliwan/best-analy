{{-- <div class="dt-divider" style="height: 50px;"></div> --}}
<section class="key-enablers mt-2">
  <h4 class="mb-1 dt-secondary">@lang('Key Enablers')</h4>
  <p>@lang($data['key:enablers:description'] ?? null)</p>

  <div class="mb-3" style="width: 1000px; height: 140px;">
    <canvas id="key-enablers-{{ $data['pindex:code'] }}" style="width: 1000px; height: 140px;"></canvas>
  </div>

  <table>
    <tr>
      <td>
        <table>
          {{-- @foreach ($data['key:enablers']['data'] as $key => $enabler) --}}
          @foreach (collect($data['key:enablers']['data'])->chunk(2) as $chunk)
            <tr>
              @foreach ($chunk as $key => $enabler)
                <td valign="top">
                  <h4>@lang($key)</h4>

                  <table width="100%">
                    <tr>
                      <td valign="middle">
                        <h4 class="mb-3 enablers-badge-index-color">{{ $data['pindex:code'] }}</h4>
                      </td>
                      <td valign="middle">
                        <div class="mb-3 text-right mr-3"><span class="enablers-badge-index">{{ $enabler['value'] }}%</span></div>
                      </td>
                    </tr>
                    <tr>
                      <td valign="middle">
                        <h4 class="mb-3 enablers-badge-org-color">{{ __('ORG. AVG') }}</h4>
                      </td>
                      <td valign="middle">
                        <div class="mb-3 text-right mr-3"><span class="enablers-badge-org">{{ $orig['keyed:data'][$key] }}%</span></div>
                      </td>
                    </tr>
                  </table>
                  <p class="mr-3">@lang($enabler['comment'])</p>
                </td>
              @endforeach
            </tr>
          @endforeach
        </table>
      </td>
    </tr>
  </table>
</section>

<script>
(function() {
  var ctx = document.getElementById("key-enablers-{{ $data['pindex:code'] }}").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    muted:             'rgb(239, 244, 250)',
    font:              'rgb(151, 172, 203)',
  };
  var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#B721FF');
      gradient.addColorStop(1, '#21D4FD');
  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode(collect($data['key:enablers']['chart']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['key:enablers']['chart']['dataset'])->values()->toArray()) !!},
          backgroundColor: '#555da6',
          label: "ORG. AVG",
        },
        {
          data: {!! json_encode(collect($orig['data'])->values()->toArray()) !!},
          backgroundColor: '#ca247a',
          label: "ORG. AVG",
        }
      ],
    },
    options: {
      events: false,
      tooltips: {
          enabled: false
      },
      hover: {
          animationDuration: 0
      },
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
                    var data = Math.round(dataset.data[index]) + '%';
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                });
            });
        }
      },
      cornerRadius: 20,
      responsive: true,
      layout: {
        padding: {
          top: 30,
          right: 20
        }
      },
      legend: {
        display: false,
        position: 'bottom',
        labels: {
          fontColor: '#044b7f',
          fontFamily: 'Rubik, sans-serif',
          fontSize: 12,
        }
      },
      scales: {
        xAxes: [{
          barPercentage: 0.3,
          gridLines: {
            display: false,
          },
          ticks: {
            beginAtZero: true,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
            min: 0,
            max: 100,
            callback: function(value){return value}
          },
        }],
        maxBarThickness: 5,
        yAxes: [{
          barPercentage: 0.3,
          gridLines: {
            display: false,
          },
          ticks: {
            callback: function(value){return value+ "%"},
            min: 0,
            max: 100,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
          }
        }]
      }
    },
  });
})();
</script>
