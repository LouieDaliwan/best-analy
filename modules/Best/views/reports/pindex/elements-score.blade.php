<div class="dt-divider" style="height: 50px;"></div>
<section>
  <div class="row">
    <div class="col-md-12">
      <div>
        <h1 class="mb-3 dt-secondary">@lang($data['pindex']) @lang('Element\'s Score')</h1>
      </div>
    </div>
  </div>

  <div class="row align-items-start justify-content-center">
    <div class="col">
      @foreach ($data['box:comments'] as $comment)
        <div class="row">
          <div class="col-auto mt-2">
            {{-- SVG arrow --}}
            <span style="font-size: 15px;">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-bottom: 6px;" xml:space="preserve" width="15px" height="15px"><g><g>
                <g>
                  <path d="M508.875,248.458l-160-160c-3.063-3.042-7.615-3.969-11.625-2.313c-3.99,1.646-6.583,5.542-6.583,9.854v21.333    c0,2.833,1.125,5.542,3.125,7.542l109.792,109.792H10.667C4.771,234.667,0,239.437,0,245.333v21.333    c0,5.896,4.771,10.667,10.667,10.667h432.917L333.792,387.125c-2,2-3.125,4.708-3.125,7.542V416c0,4.313,2.594,8.208,6.583,9.854    c1.323,0.552,2.708,0.813,4.083,0.813c2.771,0,5.5-1.083,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#107E7D"/>
                </g>
              </g></g> </svg>
            </span>
            {{-- SVG arrow --}}
          </div>
          <div class="col">
            <p>@lang($comment)</p>
          </div>
        </div>
      @endforeach
    </div>

    <div class="col-md-7">
      <div class="card mb-0">
        <div class="card-body">
          <canvas id="elements-score-{{ $data['pindex:code'] }}"></canvas>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function() {
  var ctx = document.getElementById("elements-score-{{ $data['pindex:code'] }}").getContext('2d');
  var chartColors = {
    primary:           'rgba(22, 123, 195, 1)',
    primaryLighten1:   'rgba(22, 123, 195, 0.8)',
    primaryLighten2:   'rgba(22, 123, 195, 0.5)',
    muted:             'rgb(239, 244, 250)',
    font:              'rgb(151, 172, 203)',
  };
  var gradient = ctx.createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, '#B721FF');
      gradient.addColorStop(1, '#21D4FD');
  var barChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: {!! json_encode(collect($data['elements:charts']['labels'])->values()->toArray()) !!},
      datasets: [
        {
          data: {!! json_encode(collect($data['elements:charts']['data'])->values()->toArray()) !!},
          backgroundColor: gradient,
          hoverBackgroundColor: chartColors.primary,
          // hoverBorderWidth: 1,
        }
      ],
    },
    options: {
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
          gridLines: {
            display: false,
          },
          ticks: {
            beginAtZero: true,
            fontColor: '#044b7f',
            fontFamily: 'Rubik, sans-serif',
            fontSize: 12,
            max: 100,
            callback: function(value){return value+ "%"}
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
          }
        }]
      }
    },
  });
});
</script>
