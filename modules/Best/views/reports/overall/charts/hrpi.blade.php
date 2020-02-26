<canvas height="120" class="my-3" id="hrpi-score"></canvas>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("hrpi-score").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    muted:             'rgb(239, 244, 250)',
    font:              'rgb(151, 172, 203)',
  };
  var barChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode(collect($data['indices']['HRPI']['elements:charts']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['indices']['HRPI']['elements:charts']['data'])->values()->toArray()) !!},
          backgroundColor: chartColors.primary,
          borderColor: chartColors.primary,
          fill: false,
          borderWidth: 2
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
            fontSize: 5,
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
            fontSize: 5,
          }
        }]
      }
    },
  });
});
</script>
