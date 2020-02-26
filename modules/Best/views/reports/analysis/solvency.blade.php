<section class="section">
  <h1 class="section__title text-center section__subtitle--lead">
    @lang('solvency Analysis')
  </h1>

  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="300" valign="center">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <canvas height="100" class="my-3" id="solvency"></canvas>
            </td>
          </tr>
        </table>
      </td>
      <td valign="top">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td>
              <div class="card my-3">
                <div class="card-body">
                  @foreach ($data['analysis:financial']['solvency']['comments'] as $comment)
                    <p>@lang($comment)</p>
                  @endforeach
                </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script>
$(document).ready(function() {
  var ctx = document.getElementById("solvency").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
  };
  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode(collect(
        $data['analysis:financial']['profitability']['chart']['labels'])->values()->toArray()
      ) !!},
      datasets: {!! json_encode($data['analysis:financial']['profitability']['chart']['dataset']) !!},
    },
    options: {
      animation: {
        duration: 0
      },
      "animation": {
        "duration": 1,
        "onComplete": function() {
          var chartInstance = this.chart,
            ctx = chartInstance.ctx;

          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontSize = 7,
            Chart.defaults.global.defaultFontStyle,
            Chart.defaults.global.defaultFontFamily = 'Arial, sans-serif'
            );
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';

          this.data.datasets.forEach(function(dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function(bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x, bar._model.y - 5);
            });
          });
        }
      },
      legend: {
        display: true,
        position: 'top',
        labels: {
          fontColor: '#000000',
          fontSize: 7,
          fontFamily: 'Arial, sans-serif',
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
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
            beginAtZero: true,
            fontColor: '#000000',
            fontSize: 7,
            steps: 10,
            stepValue: 10,
            max: 60
          }
        }]
      }
    },
  });
});
</script>
