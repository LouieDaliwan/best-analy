<table width="100%">
  <tr>
    <td>
      <h4 class="dt-secondary mb-0">@lang($data['indices']['FMPI']['pindex']) {{ __('Performance Index') }}</h4>
    </td>
    <td>
      <h4 class="mb-0 dt-secondary">
        {{ $data['indices']['FMPI']['overall:total'] }}%
      </h4>
    </td>
  </tr>
</table>
<div class="border-top my-3"></div>
<table>
  <tr>
    <td>
      <div class="mr-3" style="width: 500px; height: 150px;">
        <canvas id="overall-fmpi" style="width: 500px; height: 150px;"></canvas>
      </div>
    </td>
    <td>
      <p class="mb-0 mr-3">@lang($data['indices']['FMPI']['overall:comment:overall'])</p>
    </td>
  </tr>
</table>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-fmpi").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      muted:             'rgb(239, 244, 250)',
      font:              'rgb(151, 172, 203)',
    };
    var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#f48b3c');
      gradient.addColorStop(1, '#e5a676');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          ['{{ __("Cost") }}', '{{ __("Management") }}'],
          ['{{ __("Financial") }}', '{{ __("Analysis") }}'],
          ['{{ __("Financial") }}', '{{ __("Controls") }}'],
          ['{!! __("Forecasting &") !!}', '{{ __("Budgeting") }}'],
          ['{{ __("Financial Risk") }}', '{{ __("Management") }}'],
        ],
        datasets: [
          {
            data: {!! json_encode(collect($data['indices']['FMPI']['elements:charts']['data'])->values()->toArray()) !!},
            backgroundColor: gradient,
            hoverBackgroundColor: chartColors.primary,
          }
        ],
      },
      options: {
        cornerRadius: 20,
        legend: {
          position: 'bottom',
          display: false,
          labels: {
          padding: 50,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 13,
          }
        },
        scales: {
          xAxes: [{
            barPercentage: 0.2,
            categoryPercentage: 0.5,
            gridLines: {
              zeroLineColor: chartColors.primaryLighten2,
              display: false,
              color: chartColors.muted,
            },
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 13,
            },
          }],
          maxBarThickness: 3,
          yAxes: [{
            gridLines: {
              zeroLineColor: chartColors.primaryLighten2,
              display: true,
              borderDash: [8, 4],
              color: chartColors.muted,
            },
            ticks: {
              beginAtZero: true,
              padding: 20,
              maxTicksLimit: 5,
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 13,
              // min: -100,
              max: 100,
              callback: function(value){return value+ "%"}
            }
          }]
        }
      },
    });
  });
</script>

