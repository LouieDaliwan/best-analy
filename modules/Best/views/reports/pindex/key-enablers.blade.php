<div class="dt-divider" style="height: 50px;"></div>
<section class="key-enablers">
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-3 dt-secondary">@lang('Key Enablers')</h1>
        <p>@lang($data['key:enablers:description'] ?? null)</p>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <canvas height="80" class="my-3" id="key-enablers-{{ $data['pindex:code'] }}"></canvas>
    </div>
  </div>

  <div class="row">
    @foreach ($data['key:enablers']['data'] as $key => $enabler)
      <div class="col-md-6 col-sm-12">
        <h2 class="mb-3">@lang($key)</h2>

        <div class="d-flex justify-content-between mb-3">
          <div class="d-fsdsdlex align-items-center">
            {{-- <span style="width: 10px; height: 10px; background: #f43b47; display: inline-block; border-radius: 100%;"></span> --}}
            <h4 class="mb-2">{{ $data['pindex:code'] }}</h4>
            <div><span class="enablers-badge-index">{{ $enabler['value'] }}%</span></div>
          </div>
          <div class="d-flesdsx align-items-center">
            <h4 class="mb-2">{{ __('ORG. AVG') }}</h4>
            <div class="text-right"><span class="enablers-badge-org">{{ $orig['keyed:data'][$key] }}%</span></div>
          </div>
        </div>

        <p>@lang($enabler['comment'])</p>
      </div>
    @endforeach
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
          backgroundColor: '#555da6',
          label: "{{ $data['pindex:code'] }}",
          borderColor: '#555da6',
          fill: false,
          borderWidth: 3,
          pointBorderWidth: 5,
          lineTension: 0.6
        },
        {
          data: {!! json_encode(collect($orig['data'])->values()->toArray()) !!},
          backgroundColor: '#ca247a',
          label: "ORG. AVG",
          borderColor: '#ca247a',
          fill: false,
          borderWidth: 3,
          pointBorderWidth: 5,
          lineTension: 0.6
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
          usePointStyle: true,
          padding: 30,
          boxWidth: 20,
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
