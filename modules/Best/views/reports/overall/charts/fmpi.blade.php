<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="dt-secondary mb-0">@lang($data['indices']['FMPI']['pindex']) {{ __('Perfomarnce Index') }}</h2>
      <div>
        <span class="dt-button-primary-soft mx-2 font-weight-bold" style="font-size: 17px;">
          {{ $data['indices']['FMPI']['overall:total'] }}%
        </span>
      </div>
    </div>
  </div>
  <div class="border-top"></div>
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-8 col-sm-12">
        <canvas height="100" id="overall-fmpi"></canvas>
      </div>
      <div class="col-md-4">
        <p>@lang($data['indices']['FMPI']['overall:comment:overall'])</p>
      </div>
    </div>
  </div>
</div>

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
          ["Cost", "Management"],
          ["Financial", "Analysis"],
          ["Financial", "Controls"],
          ["Forecasting &", "Budgeting"],
          ["Financial Risk", "Management"],
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
            barPercentage: 0.3,
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
              // max: 100,
              callback: function(value){return value+ "%"}
            }
          }]
        }
      },
    });
  });
</script>
