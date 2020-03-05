<div class="dt-divider" style="height: 50px;"></div>
<section class="key-enablers">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-5 dt-secondary">@lang('Key Enablers')</h1>
        <p>@lang($data['key:enablers:description'] ?? null)</p>
      </div>
    </div>
  </div>

  <div class="row align-items-center">
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <canvas height="80" class="my-3" id="key-enablers-{{ $data['pindex:code'] }}"></canvas>
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
  var ctx = document.getElementById("key-enablers-{{ $data['pindex:code'] }}").getContext('2d');
  var chartColors = {
    muted:      'rgb(239, 244, 250)'
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
          backgroundColor: '#f43b47',
          label: "{{ $data['pindex:code'] }}",
          borderColor: '#f43b47',
          fill: false,
          borderWidth: 3,
          pointBorderWidth: 10,
        },
        {
          data: {!! json_encode(collect($orig['data'])->values()->toArray()) !!},
          backgroundColor: '#453a94',
          label: "ORIG. AVG",
          borderColor: '#453a94',
          fill: false,
          borderWidth: 3,
          pointBorderWidth: 10,
        },
      ],
    },
    options: {
      tooltips: {
        enabled: true,
        mode: 'single',
        callbacks: {
          label: function(tooltipItems, data) {
            return parseInt(tooltipItems.yLabel).toFixed(2)+'%';
          }
        }
      },
      legend: {
        display: true,
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
