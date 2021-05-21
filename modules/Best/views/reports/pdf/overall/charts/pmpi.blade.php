<div style="height: 10px;"></div>
<table width="100%">
  <tr>
    <td>
      <h4 class="dt-secondary mb-0">@lang($data['indices']['PMPI']['pindex']) {{ __('Performance Index') }}</h4>
    </td>
    <td>
      <h4 class="mb-0 dt-secondary">
        {{ $data['indices']['PMPI']['overall:total'] }}%
      </h4>
    </td>
  </tr>
</table>
<div class="border-top my-3"></div>
<table>
  <tr>
    <td>
      <div class="mr-3" style="width: 500px; height: 150px;">
        <canvas id="overall-pmpi"></canvas>
      </div>
    </td>
    <td>
      <p class="mb-0 mr-3">@lang($data['indices']['PMPI']['overall:comment:overall'])</p>
    </td>
  </tr>
</table>

<script>
  $(document).ready(function() {
    var ctx = document.getElementById("overall-pmpi").getContext('2d');
    var chartColors = {
      primary:           'rgba(22, 123, 195, 1)',
      primaryLighten1:   'rgba(22, 123, 195, 0.8)',
      primaryLighten2:   'rgba(22, 123, 195, 0.5)',
      muted:             'rgb(239, 244, 250)',
      font:              'rgb(151, 172, 203)',
    };
    var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#58a67e');
      gradient.addColorStop(1, '#89d7af');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          ['{!! __("Policies &") !!}', '{!! __("Procedures") !!}'],
          ['{{ __("Quality") }}', '{{ __("Management") }}'],
          ['{!! __("Technology &") !!}', '{!! __("Tools") !!}'],
          ['{{ __("Customer") }}', '{{ __("Experience") }}'],
          ['{{ __("Business") }}', '{{ __("Competitiveness") }}'],
        ],
        datasets: [
          {
            data: {!! json_encode(collect($data['indices']['PMPI']['elements:charts']['data'])->values()->toArray()) !!},
            backgroundColor: gradient,
            hoverBackgroundColor: chartColors.primary,
          }
        ],
      },
      options: {
        animation: false,
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
              fontSize: 11,
            },
          }],
          maxBarThickness: 5,
          yAxes: [{
            barPercentage: 0.3,
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
