<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="dt-secondary mb-0">@lang($data['indices']['HRPI']['pindex']) {{ __('Perfomarnce Index') }}</h2>
      <div>
        <span class="badge badge-soft-{{ $data['overall:result'] }} mx-2 font-weight-bold" style="color: {{ $data['overall:result'] }}; font-size: 17px;">
          {{ $data['indices']['HRPI']['overall:total'] }}%
        </span>
      </div>
    </div>
  </div>
  <div class="border-top"></div>
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-4">
        <p>@lang($data['indices']['HRPI']['overall:comment'])</p>
      </div>
      <div class="col-md-8 col-sm-12">
        <canvas height="100" id="overall-hrpi"></canvas>
      </div>
    </div>
  </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
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
          "Leadership",
          ["Risk", "Management"],
          ["Organisational", "Management"],
          ["Organisational", "Culture"],
        ],
        datasets: [
          {
            data: [20, 24, 21, 27],
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
