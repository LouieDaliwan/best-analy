
<!-- <div style="height: 10px;"></div> -->
<table width="100%">
  <tr>
    <td class="p-2">
      <h4 class="dt-secondary mb-0">Fifth module</h4>
    </td>
    <td class="p-2">
      <h4 class="mb-0 dt-secondary text-right">
        0%
      </h4>
    </td>
  </tr>
</table>
<div class="border-top mb-3"></div>

<canvas id="overall-fifth" width="400px" height="200px" style="margin: auto;"></canvas>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-fifth").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      muted:             'rgb(239, 244, 250)',
      font:              'rgb(151, 172, 203)',
    };
    var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#e85c5c');
      gradient.addColorStop(1, '#e37d7d');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          ['{{ __("Manpower") }}', '{{ __("Planning") }}'],
          ['{!! __("Recruitment &") !!}', '{{ __("Selection") }}'],
          ['{!! __("Compensation &") !!}', '{{ __("Benefits") }}'],
          ['{{ __("Performance") }}', '{{ __("Management") }}'],
          ['{!! __("Learning &") !!}', '{!! __("Development") !!}'],
          ['{!! __("Career & Talent") !!}', '{{ __("Management") }}'],
          ['{!! __("Employee") !!}', '{!! __("Engagement &") !!}', '{!! __("Communication") !!}'],
        ],
        datasets: [
          {
            data: {!! json_encode(collect($data['indices']['HRPI']['elements:charts']['data'])->values()->toArray()) !!},
            backgroundColor: gradient,
            hoverBackgroundColor: chartColors.primary,
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
        tooltips: {
          enabled: true,
          mode: 'single',
          callbacks: {
            label: function(tooltipItems, data) {
              return tooltipItems.xLabel+'%';
            }
          }
        },
        layout: {
          padding: {
            top: 30
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
              fontSize: 9,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            barPercentage: 0.1,
            gridLines: {
              display: false,
            },
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 12,
              min: 0,
              max: 100,
              callback: function(value){return value+ "%"}
            }
          }]
        }
      },
    });
  });
</script>