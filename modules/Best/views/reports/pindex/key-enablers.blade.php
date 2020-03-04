<div class="dt-divider" style="height: 50px;"></div>
<section class="key-enablers">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-secondary">@lang('Key Enablers')</h1>
        <p>@lang("The Financial management practices and procedures were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.")</p>
      </div>
    </div>
  </div>

  <div class="row align-items-center">
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <canvas height="80" class="my-3" id="key-enablers"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12">
      <div class="row">
        @foreach ($data['key:enablers']['data'] as $key => $enabler)
          <div class="col-md-6 col-sm-12">
            <h4 class="mb-3">@lang($key): <span class="mx-3 dt-secondary">{{ $enabler['value'] }}%</span></h4>
            <p>@lang($enabler['comment'])</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("key-enablers").getContext('2d');
  var chartColors = {
    primary:           'rgba(224, 81, 143, 1)',
    primaryLighten1:   'rgba(224, 81, 143, 0.8)',
    primaryLighten2:   'rgba(224, 81, 143, 0.5)',
    primaryLighten3:   'rgba(224, 81, 143, 0.3)',
    muted:             'rgb(239, 244, 250)'
  };
  var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, 'rgba(255, 8, 68, 0.8)');
      gradient.addColorStop(1, 'rgba(255, 177, 153, 0.8)');
  var barChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode(collect($data['key:enablers']['chart']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['key:enablers']['chart']['dataset'])->values()->toArray()) !!},
          backgroundColor: gradient,
          borderColor: 'rgb(255, 8, 68, 0.8)',
          borderWidth: 3,
          pointBorderWidth: 10,
        }
      ],
    },
    options: {
      legend: {
        display: false,
        position: 'bottom',
        labels: {
          fontColor: '#044b7f',
          fontFamily: 'Rubik, sans-serif',
          fontSize: 15,
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            zeroLineColor: chartColors.muted,
            display: false,
            color: chartColors.muted,
          },
          ticks: {
            beginAtZero: true,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 15,
          },
        }],
        maxBarThickness: 5,
        yAxes: [{
          gridLines: {
            zeroLineColor: chartColors.muted,
            display: true,
            borderDash: [8, 4],
            color: chartColors.muted,
          },
          ticks: {
            maxTicksLimit: 5,
            padding: 20,
            beginAtZero: true,
            fontSize: 12,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            callback: function(value){return value+ "%"}
          }
        }]
      }
    },
  });
});
</script>
