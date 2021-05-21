<div style="height: 10px;"></div>
<table width="100%">
  <tr>
    <td>
      <h4 class="dt-secondary mb-0">@lang($data['indices']['HRPI']['pindex']) {{ __('Performance Index') }}</h4>
    </td>
    <td>
      <h4 class="mb-0 dt-secondary">
        {{ $data['indices']['HRPI']['overall:total'] }}%
      </h4>
    </td>
  </tr>
</table>
<div class="border-top my-3"></div>
<table>
  <tr>
    <td>
      <p class="mb-0">@lang($data['indices']['HRPI']['overall:comment:overall'])</p>
    </td>
    <td>
      <div class="mr-3" style="width: 650px; height: 180px;">
        <canvas id="overall-hrpi" style="width: 650px; height: 180px;"></canvas>
      </div>
    </td>
  </tr>
</table>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-hrpi").getContext('2d');
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
            gridLines: {
              zeroLineColor: chartColors.primaryLighten2,
              display: false,
              color: chartColors.muted,
            },
            ticks: {
              fontColor: '#044b7f',
              fontFamily: 'Rubik, sans-serif',
              fontSize: 11,
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
