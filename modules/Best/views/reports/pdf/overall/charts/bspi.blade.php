<div style="height: 10px;"></div>
<table width="100%">
  <tr>
    <td>
      <h4 class="dt-secondary mb-0">@lang($data['indices']['BSPI']['pindex']) {{ __('Performance Index') }}</h4>
    </td>
    <td>
      <h4 class="mb-0 dt-secondary">
        {{ $data['indices']['BSPI']['overall:total'] }}%
      </h4>
    </td>
  </tr>
</table>
<div class="border-top my-3"></div>
<table>
  <tr>
    <td>
      <p class="mb-0">@lang($data['indices']['BSPI']['overall:comment:overall'])</p>
    </td>
    <td>
      <div class="mr-3" style="width: 500px; height: 150px;">
        <canvas id="overall-bspi" style="width: 500px; height: 150px;"></canvas>
      </div>
    </td>
  </tr>
</table>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-bspi").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      muted:             'rgb(239, 244, 250)',
      font:              'rgb(151, 172, 203)',
    };
    var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#3776a3');
      gradient.addColorStop(1, '#5f9fcc');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          '{{ __("Leadership") }}',
          ['{{ __("Risk") }}', '{{ __("Management") }}'],
          ['{{ __("Organisational") }}', '{{ __("Management") }}'],
          ['{{ __("Organisational") }}', '{{ __("Culture") }}'],
        ],
        datasets: [
          {
            data: {!! json_encode(collect($data['indices']['BSPI']['elements:charts']['data'])->values()->toArray()) !!},
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

