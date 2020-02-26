<section class="section">
  <h1 class="section__title text-center section__subtitle--lead">
    @lang('Financial Management Element\'s Score')
  </h1>

  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td valign="top">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <div class="card my-3">
                <div class="card-body">
                  <ul>
                    @foreach ($data['box:comments'] as $comment)
                      <li>@lang($comment)</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
      <td style="font-size: 0; line-height: 0;" width="20">
        &nbsp;
      </td>
      <td width="300" valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <canvas width="300" class="my-3" id="elements-score"></canvas>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("elements-score").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    muted:             'rgb(239, 244, 250)',
    font:              'rgb(151, 172, 203)',
  };
  var barChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: {!! json_encode(collect($data['elements:charts']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['elements:charts']['data'])->values()->toArray()) !!},
          backgroundColor: chartColors.primary
        }
      ],
    },
    options: {
      layout: {
        padding: {
          right: 20
        }
      },
      showAllTooltips: true,
      animation: {
        duration: 0
      },
      "animation": {
        "duration": 1,
        "onComplete": function() {
          var chartInstance = this.chart,
            ctx = chartInstance.ctx;

          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontSize = 9,
            Chart.defaults.global.defaultFontStyle,
            Chart.defaults.global.defaultFontFamily = 'Arial, sans-serif'
            );
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';

          this.data.datasets.forEach(function(dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function(bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x - -10, bar._model.y - -6);
            });
          });
        }
      },
      legend: {
        display: false,
        position: 'bottom',
        labels: {
          fontColor: '#000000',
          fontFamily: 'Arial, sans-serif',
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
            beginAtZero: true,
            fontColor: '#000000',
            fontSize: 7,
          },
        }],
        maxBarThickness: 5,
        yAxes: [{
          barPercentage: 0.4,
          gridLines: {
            display: false,
          },
          ticks: {
            fontColor: '#000000',
            fontSize: 7,
          }
        }]
      }
    },
  });
});
</script>
